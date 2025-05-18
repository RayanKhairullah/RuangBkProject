<?php

namespace App\Http\Controllers;

use App\Models\Biodata;
use App\Models\Jurusan;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Enums\UserRole;

class BiodataController extends Controller
{
    public function create()
    {
        // Hanya siswa (role user) yang boleh membuat biodata
        if (Auth::user()->role !== UserRole::User) {
            abort(403, 'Unauthorized action.');
        }

        // Redirect ke edit jika sudah ada biodata 
        if (Auth::user()->biodata) {
            return redirect()
                ->route('biodatas.edit', Auth::user()->biodata->id)
                ->with('error', 'Anda sudah memiliki biodata.');
        }

        return view('biodatas.create');
    }

    public function store(Request $request)
    {
        // Validasi seluruh field sesuai migration terbaru
        $request->validate([
            'nama_siswa'        => 'required|string|max:255',
            'nisn'              => 'required|string|max:255|unique:biodatas,nisn',
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            // 'jurusan_id'        => 'required|exists:jurusans,id',
            // 'room_id'          => 'required|exists:rooms,id',
            'kode_rooms'        => 'required|exists:rooms,kode_rooms',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required|date',
            'telepon'           => 'required|string|max:15',
            'agama'             => 'required|in:Islam,Kristen,Hindu,Budha,Lainnya',
            'alamat_ktp'        => 'required|string',
            'alamat_domisili'   => 'nullable|string',
            'cita_cita'         => 'nullable|string|max:255',
            'hobi'              => 'nullable|string|max:255',
            'minat_bakat'       => 'nullable|string',
            'sd'                => 'nullable|string|max:255',
            'smp'               => 'nullable|string|max:255',
            'nama_ayah'         => 'nullable|string|max:255',
            'pekerjaan_ayah'    => 'nullable|string|max:255',
            'no_hp_ayah'        => 'nullable|string|max:15',
            'nama_ibu'          => 'nullable|string|max:255',
            'pekerjaan_ibu'     => 'nullable|string|max:255',
            'no_hp_ibu'         => 'nullable|string|max:15',
            'gol_darah'         => 'nullable|in:A,B,AB,O',
            'status'            => 'nullable|string|max:255',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room = Room::where('kode_rooms',$request->kode_rooms)->first();

        // Proses upload gambar jika ada
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('foto-biodata', 'public');
        }

        // Simpan data biodata
        $data = array_merge(
            $request->only([
                'nama_siswa','nisn','jenis_kelamin',
                'tempat_lahir','tanggal_lahir','telepon','agama',
                'alamat_ktp','alamat_domisili','cita_cita','hobi','minat_bakat',
                'sd','smp','nama_ayah','pekerjaan_ayah','no_hp_ayah',
                'nama_ibu','pekerjaan_ibu','no_hp_ibu','gol_darah','status'
            ]),
            ['user_id' => Auth::id(), 'image' => $imagePath]
        );

                $data['user_id'] = Auth::id();
        $data['room_id'] = $room->id;
        $data['jurusan_id'] = $room->jurusan_id;
        $data['image'] = $imagePath;

        Biodata::create($data);

        return redirect()
            ->route('biodatas.show', Auth::user()->biodata->id)
            ->with('success', 'Biodata berhasil dibuat.');
    }

    public function edit()
    {
        if (Auth::user()->role !== UserRole::User) {
            abort(403, 'Unauthorized action.');
        }
        $biodata = Auth::user()->biodata;

        if (! $biodata) {
            return redirect()
                ->route('biodatas.create')
                ->with('error', 'Silakan buat biodata terlebih dahulu.');
        }

        return view('biodatas.edit',compact('biodata'));
    }

    public function update(Request $request)
    {
        $biodata = Auth::user()->biodata;
        if (! $biodata) {
            return redirect()
                ->route('biodatas.create')
                ->with('error', 'Silakan buat biodata terlebih dahulu.');
        }

        // Validasi—sama seperti store, tapi nisn unique kecuali id sendiri
        $request->validate([
            'nama_siswa'        => 'required|string|max:255',
            'nisn'              => 'required|string|max:255|unique:biodatas,nisn,' . $biodata->id,
            'jenis_kelamin'     => 'required|in:Laki-laki,Perempuan',
            // 'jurusan_id'        => 'required|exists:jurusans,id',
            // 'room_id'          => 'required|exists:rooms,id',
            'kode_rooms'        => 'required|exists:rooms,kode_rooms',
            'tempat_lahir'      => 'required|string|max:255',
            'tanggal_lahir'     => 'required|date',
            'telepon'           => 'required|string|max:15',
            'agama'             => 'required|in:Islam,Kristen,Hindu,Budha,Lainnya',
            'alamat_ktp'        => 'required|string',
            'alamat_domisili'   => 'nullable|string',
            'cita_cita'         => 'nullable|string|max:255',
            'hobi'              => 'nullable|string|max:255',
            'minat_bakat'       => 'nullable|string',
            'sd'                => 'nullable|string|max:255',
            'smp'               => 'nullable|string|max:255',
            'nama_ayah'         => 'nullable|string|max:255',
            'pekerjaan_ayah'    => 'nullable|string|max:255',
            'no_hp_ayah'        => 'nullable|string|max:15',
            'nama_ibu'          => 'nullable|string|max:255',
            'pekerjaan_ibu'     => 'nullable|string|max:255',
            'no_hp_ibu'         => 'nullable|string|max:15',
            'gol_darah'         => 'nullable|in:A,B,AB,O',
            'status'            => 'nullable|string|max:255',
            'image'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $room = Room::where('kode_rooms',$request->kode_rooms)->first();
        $update = $request->except('image');
        $update['room_id']=$room->id;
        $update['jurusan_id']=$room->jurusan_id;
        $biodata->update($update);

        if ($request->hasFile('image')) {
            if ($biodata->image) Storage::disk('public')->delete($biodata->image);
            $biodata->update(['image'=>$request->file('image')->store('foto-biodata','public')]);
        }

        return redirect()->route('biodatas.show',$biodata->id)
                            ->with('success','Biodata berhasil diperbarui.');
    }

    public function show()
    {
        $biodata = Auth::user()->biodata;
        if (! $biodata) {
            return redirect()
                ->route('biodatas.create')
                ->with('error', 'Silakan buat biodata terlebih dahulu.');
        }
        return view('biodatas.show', compact('biodata'));
    }
}