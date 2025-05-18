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
    public function index()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $rooms = Room::with('jurusan')->paginate(10); // Gunakan paginate langsung tanpa get()
        return view('rooms.index', compact('rooms'));
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