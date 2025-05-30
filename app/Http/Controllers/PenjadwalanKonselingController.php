<?php
namespace App\Http\Controllers;

use App\Enums\UserRole; 
use App\Models\PenjadwalanKonseling;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\KonselingNotification;
use Illuminate\Support\Facades\Mail;
use App\Exports\PenjadwalanKonselingExport;        
use Maatwebsite\Excel\Facades\Excel; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;

class PenjadwalanKonselingController extends Controller
{
    public function index(Request $request)
    {
        // Hanya pengirim atau penerima
        $baseQuery = PenjadwalanKonseling::with(['pengirim', 'penerima'])
            ->where('pengirim_id', Auth::id())
            ->orWhere('penerima_id', Auth::id());

        // Daftar filter yang diperbolehkan
        $allowedFilters = [
            'pengirim'   => fn($q, $v) => $q->whereHas('pengirim', fn($q2) => $q2->where('email', 'like', "%{$v}%")),
            'lokasi'     => fn($q, $v) => $q->where('lokasi', 'like', "%{$v}%"),
            'tanggal'    => fn($q, $v) => $q->whereDate('tanggal', $v),
            'status'     => fn($q, $v) => $q->where('status', $v),  // hanya untuk guru
        ];

        // Apply setiap filter yang ada di query string
        foreach ($request->only(array_keys($allowedFilters)) as $filter => $value) {
            if ($value !== null && $value !== '') {
                $baseQuery = $allowedFilters[$filter]($baseQuery, $value);
            }
        }

        // Paginate dan retain query string
        $jadwals = $baseQuery
            ->orderBy('tanggal', 'desc')
            ->paginate(5)
            ->withQueryString();

        return view('penjadwalan.index', compact('jadwals'));
    }

    public function create()
    {
        // Batasi akses hanya untuk pengguna dengan role User
        if (Auth::user()->role !== UserRole::User) {
            abort(403, 'Unauthorized action.');
        }

        // Tampilkan dropdown dengan data guru saja
        $users = User::where('role', UserRole::Teacher)->get();

        return view('penjadwalan.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Batasi akses hanya untuk pengguna dengan role User
        if (Auth::user()->role !== UserRole::User) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'topik_dibahas' => 'required|string',
        ]);

        PenjadwalanKonseling::create([
            'pengirim_id' => Auth::id(),
            'nama_pengirim' => Auth::user()->name,
            'penerima_id' => $request->penerima_id,
            'nama_penerima' => User::find($request->penerima_id)->name,
            'lokasi' => $request->lokasi,
            'tanggal' => $request->tanggal,
            'topik_dibahas' => $request->topik_dibahas,
        ]);

        return redirect()->route('penjadwalan.index')->with('success', 'Jadwal konseling berhasil dibuat.');
    }
    public function edit(PenjadwalanKonseling $penjadwalan)
    {
        if (Auth::id() !== $penjadwalan->pengirim_id && Auth::id() !== $penjadwalan->penerima_id) {
            abort(403, 'Unauthorized action.');
        }

        return view('penjadwalan.edit', compact('penjadwalan'));
    }

    public function update(Request $request, PenjadwalanKonseling $penjadwalan)
    {
        // Pastikan hanya pengirim atau penerima yang dapat mengubah data
        if (Auth::id() !== $penjadwalan->pengirim_id && Auth::id() !== $penjadwalan->penerima_id) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi data umum
        $data = $request->validate([
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'topik_dibahas' => 'required|string',
            'nama_pengirim' => 'nullable|string|max:255',
            'nama_penerima' => 'nullable|string|max:255',
        ]);

        // Hanya guru yang bisa mengupdate solusi dan status
        if (Auth::user()->role === UserRole::Teacher) {
            $dataTeacher = $request->validate([
                'solusi' => 'nullable|string',
                'status' => 'required|in:pending,accepted,rejected',
            ]);
            $data = array_merge($data, $dataTeacher);
        }

        $penjadwalan->update($data);

        return redirect()->route('penjadwalan.index')->with('success', 'Jadwal konseling berhasil diperbarui.');
    }

    public function send(PenjadwalanKonseling $penjadwalan)
    {
        // Pastikan hanya pengirim atau penerima yang dapat mengirim email
        if (Auth::id() !== $penjadwalan->pengirim_id && Auth::id() !== $penjadwalan->penerima_id) {
            abort(403, 'Unauthorized action.');
        }
    
        // Kirim email ke penerima
        Mail::to($penjadwalan->penerima->email)->send(new KonselingNotification($penjadwalan));
    
        return redirect()->route('penjadwalan.index')->with('success', 'Jadwal berhasil dikirim ke email penerima.');
    }

    public function destroy(PenjadwalanKonseling $penjadwalan)
    {
        if (Auth::id() !== $penjadwalan->pengirim_id && Auth::id() !== $penjadwalan->penerima_id) {
            abort(403, 'Unauthorized action.');
        }

        $penjadwalan->delete();

        return redirect()->route('penjadwalan.index')->with('success', 'Jadwal konseling berhasil dihapus.');
    }

    public function downloadAll()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $fileName = 'penjadwalan_konseling_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(new PenjadwalanKonselingExport(), $fileName);
    }

    public function acceptAndRedirectToCalendar(PenjadwalanKonseling $penjadwalan)
    {
        // Pastikan hanya penerima yang dapat menerima jadwal
        if (Auth::id() !== $penjadwalan->penerima_id) {
            abort(403);
        }

        // Update status menjadi 'accepted'
        $penjadwalan->update(['status' => 'accepted']);

        // Buat URL Google Calendar
        $start = Carbon::parse($penjadwalan->tanggal)->format('Ymd\THis\Z');
        $end = Carbon::parse($penjadwalan->tanggal)->addHour()->format('Ymd\THis\Z');
        $googleCalendarUrl = 'https://www.google.com/calendar/render?action=TEMPLATE' .
            '&text=' . urlencode('Jadwal Konseling: ' . $penjadwalan->topik_dibahas) .
            '&dates=' . $start . '/' . $end .
            '&details=' . urlencode('Lokasi: ' . $penjadwalan->lokasi . "\nTopik Dibahas: " . $penjadwalan->topik_dibahas) .
            '&location=' . urlencode($penjadwalan->lokasi) .
            '&sf=true&output=xml';

        // Redirect ke Google Calendar
        return Redirect::away($googleCalendarUrl);
    }

    public function reject(PenjadwalanKonseling $penjadwalan)
    {
        if (Auth::id() !== $penjadwalan->penerima_id) {
            abort(403);
        }

        $penjadwalan->update(['status' => 'rejected']);

        return redirect()->route('penjadwalan.index')
                        ->with('success', 'Anda telah **menolak** jadwal ini.');
    }
}