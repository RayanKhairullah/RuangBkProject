<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BiodataController extends Controller
{
    public function create()
    {
        if (Auth::user()->biodata) {
            return redirect()->route('biodatas.edit')->with('error', 'Anda sudah memiliki biodata.');
        }

        $jurusans = Jurusan::all();
        $rooms = Room::take(3)->get();
        return view('biodatas.create', compact('jurusans', 'rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn' => 'required|string|max:255|unique:biodatas,nisn',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jurusan_id' => 'required|exists:jurusans,id',
            'rooms_id' => 'required|exists:rooms,id',
            'telepon' => 'required|string|max:15',
            'agama' => 'required|in:Islam,Kristen,Hindu,Budha,Lainnya',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'gol_darah' => 'required|in:A,B,AB,O',
            'status' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foto-biodata', 'public');
        }

        Biodata::create([
            'user_id' => Auth::id(),
            'nisn' => $request->nisn,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan_id' => $request->jurusan_id,
            'rooms_id' => $request->rooms_id,
            'telepon' => $request->telepon,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'gol_darah' => $request->gol_darah,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return redirect()->route('biodatas.edit')->with('success', 'Biodata berhasil dibuat.');
    }

    public function edit()
    {
        $biodata = Auth::user()->biodata;

        if (!$biodata) {
            return redirect()->route('biodatas.create')->with('error', 'Silakan buat biodata terlebih dahulu.');
        }

        $jurusans = Jurusan::all();
        $rooms = Room::take(3)->get();
        return view('biodatas.edit', compact('biodata', 'jurusans', 'rooms'));
    }

    public function update(Request $request)
    {
        $biodata = Auth::user()->biodata;

        if (!$biodata) {
            return redirect()->route('biodatas.create')->with('error', 'Silakan buat biodata terlebih dahulu.');
        }

        $request->validate([
            'nisn' => 'required|string|max:255|unique:biodatas,nisn,' . $biodata->id,
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'jurusan_id' => 'required|exists:jurusans,id',
            'rooms_id' => 'required|exists:rooms,id',
            'telepon' => 'required|string|max:15',
            'agama' => 'required|in:Islam,Kristen,Hindu,Budha,Lainnya',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'gol_darah' => 'required|in:A,B,AB,O',
            'status' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update data teks kecuali image
        $biodata->update($request->except('image'));

        // Proses update image jika ada file baru diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($biodata->image && Storage::disk('public')->exists($biodata->image)) {
                Storage::disk('public')->delete($biodata->image);
            }

            $imagePath = $request->file('image')->store('foto-biodata', 'public');
            $biodata->update(['image' => $imagePath]);
        }

        return redirect()->route('biodatas.show')->with('success', 'Biodata berhasil diperbarui.');
    }

    public function show()
    {
        $biodata = Auth::user()->biodata;

        if (!$biodata) {
            return redirect()->route('biodatas.create')->with('error', 'Silakan buat biodata terlebih dahulu.');
        }

        return view('biodatas.show', compact('biodata'));
    }
}