<?php

namespace App\Http\Controllers;

use App\Models\SuratPanggilan;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPanggilanController extends Controller
{
    public function index()
    {
        $items = SuratPanggilan::with('siswa.biodata.rooms.jurusan')->latest()->paginate(10);
        return view('surat-panggilan.index', compact('items'));
    }

    public function create()
    {
        $siswa = User::with('biodata.rooms')->where('role', 'user')->get();
        $siswa = $siswa->filter(function ($s) {
            return $s->biodata !== null;
        });
        return view('surat-panggilan.create', compact('siswa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'nomor_surat'  => 'required|string',
            'penyebab'     => 'required|string',
            'tanggal'      => 'required|date',
            'waktu'        => 'required|string',
            'tempat'       => 'required|string',
            'tujuan'       => 'required|string',
        ]);

        SuratPanggilan::create($data);

        return redirect()->route('surat-panggilan.index')
                         ->with('success', 'Surat panggilan berhasil dibuat.');
    }

    public function show(SuratPanggilan $suratPanggilan)
    {
        return view('surat-panggilan.show', compact('suratPanggilan'));
    }

    public function edit(SuratPanggilan $suratPanggilan)
    {
        $siswa = User::where('role', 'user')->get();
        return view('surat-panggilan.edit', compact('suratPanggilan', 'siswa'));
    }

    public function update(Request $request, SuratPanggilan $suratPanggilan)
    {
        $data = $request->validate([
            'user_id'      => 'required|exists:users,id',
            'nomor_surat'  => 'required|string',
            'penyebab'     => 'required|string',
            'tanggal'      => 'required|date',
            'waktu'        => 'required|string',
            'tempat'       => 'required|string',
            'tujuan'       => 'required|string',
        ]);

        $suratPanggilan->update($data);

        return redirect()->route('surat-panggilan.index')
                         ->with('success', 'Surat panggilan berhasil diperbarui.');
    }

    public function destroy(SuratPanggilan $suratPanggilan)
    {
        $suratPanggilan->delete();
        return back()->with('success', 'Surat panggilan berhasil dihapus.');
    }

    public function generate($id)
    {
        $sp = SuratPanggilan::with('siswa.biodata.rooms.jurusan')->findOrFail($id);
        $data = [
            'nama_sekolah'          => 'Nama Sekolah',
            'alamat_sekolah'        => 'Alamat Sekolah',
            'telepon_sekolah'       => 'Telp/Email Sekolah',
            'nomor_surat'           => $sp->nomor_surat,
            'nama_orang_tua'        => $sp->siswa->biodata->user->name,
            'alamat_orang_tua'      => $sp->siswa->biodata->alamat,
            'nama_siswa'            => $sp->siswa->biodata->user->name,
            'kelas'                 => $sp->siswa->biodata->rooms->tingkatan_rooms,
            'nisn'                  => $sp->siswa->biodata->nisn,
            'penyebab'              => $sp->penyebab,
            'tanggal'               => $sp->tanggal->format('d F Y'),
            'waktu'                 => $sp->waktu,
            'tempat'                => $sp->tempat,
            'tujuan'                => $sp->tujuan,
            'nama_kepala_sekolah'   => 'Nama Kepala Sekolah',
            'jabatan_kepala_sekolah'=> 'Kepala Sekolah',
        ];

        $pdf = Pdf::loadView('surat-panggilan.template', $data);
        return $pdf->download("Surat_Panggilan_{$sp->siswa->biodata->user->name}.pdf");
    }
}