<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use APp\Enums\UserRole;

class JurusanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $jurusans = Jurusan::paginate(5);
        return view('jurusans.index', compact('jurusans'));
    }

    public function create()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        return view('jurusans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
        ]);

        Jurusan::create($request->all());

        return redirect()->route('jurusans.index')->with('success', 'Jurusan created successfully.');
    }

    // public function edit(Jurusan $jurusan)
    // {
    //     if (Auth::user()->role !== UserRole::Teacher) {
    //         abort(403, 'Unauthorized action.');
    //     }
    //     return view('jurusans.edit', compact('jurusan'));
    // }

    // public function update(Request $request, Jurusan $jurusan)
    // {
    //     $request->validate([
    //         'nama_jurusan' => 'required|string|max:255',
    //     ]);

    //     $jurusan->update($request->all());

    //     return redirect()->route('jurusans.index')->with('success', 'Jurusan updated successfully.');
    // }

    public function show(Jurusan $jurusan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $rooms = $jurusan->rooms; // Ambil semua room yang terkait dengan jurusan
        return view('jurusans.show', compact('jurusan', 'rooms'));
    }

    public function destroy(Jurusan $jurusan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $jurusan->delete();

        return redirect()->route('jurusans.index')->with('success', 'Jurusan deleted successfully.');
    }
}