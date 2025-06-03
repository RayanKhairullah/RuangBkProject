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
use Illuminate\Support\Facades\Log;

class PenjadwalanKonselingController extends Controller
{
    public function index(Request $request)
    {
        // Hanya pengirim atau penerima
        $baseQuery = PenjadwalanKonseling::with(['pengirim', 'penerima'])
            ->where(function($query) {
                $query->where('pengirim_id', Auth::id())
                      ->orWhere('penerima_id', Auth::id());
            });

        // Apply filters
        if ($request->filled('penerima')) {
            $baseQuery->where('penerima_id', $request->penerima);
        }

        // Account Pengirim (Filter by email OR nama_pengirim)
        if ($request->filled('pengirim')) {
            $searchTerm = '%' . $request->pengirim . '%';
            $baseQuery->where(function($query) use ($searchTerm) {
                $query->whereHas('pengirim', function ($q) use ($searchTerm) {
                    $q->where('email', 'like', $searchTerm);
                })->orWhere('nama_pengirim', 'like', $searchTerm); // Filter by nama_pengirim
            });
        }

        if ($request->filled('lokasi')) {
            $searchTerm = '%' . mb_strtolower($request->lokasi) . '%'; // Konversi input ke lowercase
            $baseQuery->whereRaw('LOWER(lokasi) LIKE ?', [$searchTerm]); // Bandingkan kolom juga dalam lowercase
        }

        // Tanggal
        if ($request->filled('tanggal')) {
            // Ensure the date format matches the database format (YYYY-MM-DD)
            // Carbon::parse() is robust for different date inputs
            try {
                $date = Carbon::parse($request->tanggal)->format('Y-m-d');
                $baseQuery->whereDate('tanggal', $date);
            } catch (\Exception $e) {
                // Log the error or handle it as appropriate, e.g., ignore invalid date input
                // For now, we'll just ignore it, but in a real app, you might flash a message
                Log::error("Invalid date format for filter: " . $request->tanggal . " Error: " . $e->getMessage());
            }
        }

        // Status (only for teacher role)
        if (Auth::user()->role === UserRole::Teacher && $request->filled('status')) {
            $baseQuery->where('status', $request->status);
        }

        // Paginate and retain query string
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