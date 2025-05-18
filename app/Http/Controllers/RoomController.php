<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use APp\Enums\UserRole;

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
        $rooms    = Room::all();
        return view('rooms.create', compact('jurusans', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jurusan_id' => 'required|exists:jurusans,id',
            'tingkatan_rooms' => 'required|string|max:255',
        ]);

        $kode_rooms = strtoupper(Str::random(4)); // Generate kode unik

        Room::create([
            'jurusan_id' => $request->jurusan_id,
            'kode_rooms' => $kode_rooms,
            'tingkatan_rooms' => $request->tingkatan_rooms,
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
            'tingkatan_rooms' => 'required|string|max:255',
        ]);

        $room->update([
            'jurusan_id' => $request->jurusan_id,
            'tingkatan_rooms' => $request->tingkatan_rooms,
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
}