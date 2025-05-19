<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CatatanExport;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->role === UserRole::Teacher) {
            $baseQuery = Catatan::with(['user','room','guru']);
        } else {
            $baseQuery = Catatan::with(['user','room','guru'])
                ->where('user_id', Auth::id());
        }

        // Filter yang diperbolehkan
        $allowedFilters = [
            'siswa'      => fn($q,$v) => $q->where('user_id', $v),
            'room'       => fn($q,$v) => $q->where('room_id', $v),
            'tanggal'    => fn($q,$v) => $q->whereDate('tanggal', $v),
            'poin_min'   => fn($q,$v) => $q->where('poin', '>=', $v),
            'poin_max'   => fn($q,$v) => $q->where('poin', '<=', $v),
        ];

        foreach ($request->only(array_keys($allowedFilters)) as $filter=>$value) {
            if ($value !== null && $value !== '') {
                $baseQuery = $allowedFilters[$filter]($baseQuery, $value);
            }
        }

        $catatans = $baseQuery
            ->orderBy('tanggal','desc')
            ->paginate(5)
            ->withQueryString();

        $students = Auth::user()->role === UserRole::Teacher
            ? User::where('role', UserRole::User)->get()
            : [];

        $rooms    = Room::all();

        return view('catatans.index', compact('catatans','students','rooms'));
    }

    public function create()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::where('role', UserRole::User)->get(); // ambil siswa saja
        $rooms = Room::all();
        return view('catatans.create', compact('users', 'rooms'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'user_id' => 'nullable|exists:users,id',  // Opsional
            'room_id' => 'required|exists:rooms,id',
            'nama_siswa' => 'required|string|max:255', // Input manual// Otomatis diisi dengan akun login
            'guru_pembimbing' => 'required|string|max:255', // Input manual
            'kasus' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'catatan_guru' => 'required|string',
            'poin' => 'required|integer|min:1|max:150',
        ]);

        Catatan::create([
            'user_id' => $request->user_id ?: null, // Opsional
            'room_id' => $request->room_id,
            'guru_id' => Auth::id(), // Otomatis diisi dengan akun login
            'nama_siswa' => $request->nama_siswa,
            'guru_pembimbing' => $request->guru_pembimbing,
            'kasus' => $request->kasus,
            'tanggal' => $request->tanggal,
            'catatan_guru' => $request->catatan_guru,
            'poin' => $request->poin,
        ]);

        return redirect()->route('catatans.index')->with('success', 'Catatan berhasil dibuat.');
    }

    public function edit(Catatan $catatan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::where('role', UserRole::User)->get();
        $rooms = Room::all();
        return view('catatans.edit', compact('catatan', 'users', 'rooms'));
    }

    public function update(Request $request, Catatan $catatan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'user_id' => 'nullable|exists:users,id', // Opsional
            'room_id' => 'required|exists:rooms,id',           
            'nama_siswa' => 'required|string|max:255', // Input manual
            'guru_pembimbing' => 'required|string|max:255', // Input manual
            'kasus' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'catatan_guru' => 'required|string',
            'poin' => 'required|integer|min:1|max:150',
        ]);

        // Perbarui data catatan
        $catatan->update([
            'user_id' => $request->user_id,
            'room_id' => $request->room_id,
            'guru_id' => Auth::id(),
            'nama_siswa' => $request->nama_siswa,
            'guru_pembimbing' => $request->guru_pembimbing,
            'kasus' => $request->kasus,
            'tanggal' => $request->tanggal,
            'catatan_guru' => $request->catatan_guru,
            'poin' => $request->poin,
        ]);

        return redirect()->route('catatans.index')->with('success', 'Catatan berhasil diperbarui.');
    }
    public function destroy(Catatan $catatan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $catatan->delete();

        return redirect()->route('catatans.index')->with('success', 'Catatan berhasil dihapus.');
    }
    public function downloadAll()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        abort_unless(Auth::user()->role === UserRole::Teacher, 403);
        $fileName = 'catatan_semua_' . now()->format('Ymd_His') . '.xlsx';
        return Excel::download(
            new CatatanExport(null),
            $fileName
        );
    }

    public function downloadByUser(Request $request)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama_siswa' => 'required|exists:users,id', // Validasi menggunakan user_id
        ]);

        $userId = $request->nama_siswa; // Ambil user_id dari request
        $user = User::findOrFail($userId); // Ambil data user berdasarkan ID
        $userName = str_replace(' ', '_', strtolower($user->name)); // Format nama siswa (contoh: "User One" menjadi "user_one")
        $fileName = "catatan_siswa_{$userName}_" . now()->format('Ymd_His') . '.xlsx';

        return Excel::download(
            new CatatanExport($userId),
            $fileName
        );
    }

    public function show(Catatan $catatan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        return view('catatans.show', compact('catatan'));
    }
}