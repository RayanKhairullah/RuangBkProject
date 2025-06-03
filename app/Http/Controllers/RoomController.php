<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;
use App\Models\User;
use App\Exports\BiodataExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Hanya guru yang boleh mengakses
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        // Daftar filter yang diperbolehkan beserta callback-nya
        $allowedFilters = [
            'jurusan'       => fn($query, $value) => $query->where('jurusan_id', $value),
            'kode_rooms'    => fn($query, $value) => $query->where('kode_rooms', 'like', "%{$value}%"),
            'tingkatan'     => fn($query, $value) => $query->where('tingkatan_rooms', 'like', "%{$value}%"),
        ];

        // Query dasar: relasi jurusan + pagination nanti
        $query = Room::with('jurusan');

        // Apply semua filter yang ada di request
        foreach ($request->only(array_keys($allowedFilters)) as $filter => $value) {
            if ($value !== null && $value !== '') {
                $query = $allowedFilters[$filter]($query, $value);
            }
        }

        // Urut, paginate, dan retain query string
        $rooms = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        // Untuk dropdown jurusan di form
        $jurusans = Jurusan::all();

        return view('rooms.index', compact('rooms', 'jurusans'));
    }


    public function create()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $jurusans = Jurusan::all();
        $rooms    = Room::all(); // Ini tidak diperlukan di sini untuk tampilan create
        return view('rooms.create', compact('jurusans')); // Hapus 'rooms' jika tidak digunakan
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'tingkatan_rooms' => [
                'required',
                'string',
                'max:255',
                // Aturan unique dengan scope ke jurusan_id dan angkatan_rooms
                Rule::unique('rooms')->where(function ($query) use ($request) {
                    return $query->where('jurusan_id', $request->jurusan_id)
                                 ->where('angkatan_rooms', $request->angkatan_rooms);
                }),
            ],
            'angkatan_rooms' => 'required|string|max:255',
            'tahun_ajaran_mulai' => 'nullable|date',
            'tahun_ajaran_berakhir' => 'nullable|date',
        ], [
            'tingkatan_rooms.unique' => 'Kombinasi Jurusan, Angkatan, dan Tingkatan Kelas ini sudah ada.',
        ]);

        Room::create([
            'jurusan_id' => $request->jurusan_id,
            'kode_rooms' => strtoupper(Str::random(4)), // Generate kode unik
            'tingkatan_rooms' => $request->tingkatan_rooms,
            'angkatan_rooms' => $request->angkatan_rooms,
            'tahun_ajaran_mulai' => $request->tahun_ajaran_mulai,
            'tahun_ajaran_berakhir' => $request->tahun_ajaran_berakhir,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $jurusans = Jurusan::all();
        return view('rooms.edit', compact('room', 'jurusans'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'tingkatan_rooms' => [
                'required',
                'string',
                'max:255',
                // Aturan unique dengan scope ke jurusan_id dan angkatan_rooms,
                // dan mengabaikan record saat ini ($room->id)
                Rule::unique('rooms')->where(function ($query) use ($request) {
                    return $query->where('jurusan_id', $request->jurusan_id)
                                 ->where('angkatan_rooms', $request->angkatan_rooms);
                })->ignore($room->id),
            ],
            'angkatan_rooms' => 'required|string|max:255',
            'tahun_ajaran_mulai' => 'nullable|date',
            'tahun_ajaran_berakhir' => 'nullable|date',
        ], [
            'tingkatan_rooms.unique' => 'Kombinasi Jurusan, Angkatan, dan Tingkatan Kelas ini sudah ada.',
        ]);

        $room->update([
            'jurusan_id' => $request->jurusan_id,
            'tingkatan_rooms' => $request->tingkatan_rooms,
            'angkatan_rooms' => $request->angkatan_rooms,
            'tahun_ajaran_mulai' => $request->tahun_ajaran_mulai,
            'tahun_ajaran_berakhir' => $request->tahun_ajaran_berakhir,
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function show(Room $room)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $users = $room->users;
        return view('rooms.show', compact('room', 'users'));
    }

    public function destroy(Room $room)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $room->delete();

        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }

    public function showUserBiodata(Room $room, User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        // Cek apakah user berada di room yang dimaksud
        if ($user->kode_rooms !== $room->kode_rooms) {
            abort(403, 'User tidak berada di kelas ini.');
        }

        $biodata = $user->biodata;

        if (!$biodata) {
            return redirect()->route('rooms.show', $room)->with('error', 'Biodata tidak ditemukan.');
        }

        return view('rooms.biodata', compact('biodata', 'user', 'room'));
    }

    public function destroyUser(Room $room, User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        // Pastikan user dari room yang sama
        if ($user->kode_rooms !== $room->kode_rooms) {
            abort(403, 'User tidak berada di kelas ini.');
        }

        $user->delete();
        return redirect()->route('rooms.show', $room)->with('success', 'User berhasil dihapus dari kelas.');
    }

    public function downloadUserBiodata(Room $room, User $user)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->kode_rooms !== $room->kode_rooms) {
            abort(403, 'User tidak berada di kelas ini.');
        }

        if (! $user->biodata) {
            return back()->withError('Biodata tidak ditemukan.');
        }

        $fileName = 'biodata_' . str()->slug($user->name) . '.xlsx';
        return Excel::download(new BiodataExport($user), $fileName);
    }
}