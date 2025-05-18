<?php

namespace App\Http\Controllers;

use App\Models\SuratPanggilan;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Jurusan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class SuratPanggilanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $suratPanggilans = SuratPanggilan::latest()->paginate(10);
        return view('surat_panggilans.index', compact('suratPanggilans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $rooms = Room::with('jurusan')->get();
        return view('surat_panggilans.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_siswa'       => 'required|string|max:255',
            'room_id'         => 'required|exists:rooms,id',
            'nomor_surat'      => 'required|string|max:100|unique:surat_panggilans,nomor_surat',
            'tanggal_waktu'    => 'required|date',
            'tempat'           => 'required|string|max:255',
            'tujuan'           => 'required|string',
        ]);

        $room = Room::with('jurusan')->findOrFail($data['room_id']);
        $data['jurusan'] = $room->kode_rooms
                        . ' - ' . $room->jurusan->nama_jurusan
                        . ' - ' . $room->tingkatan_rooms;

        SuratPanggilan::create($data);

        return redirect()->route('surat_panggilans.index')
                         ->with('success', 'Surat Panggilan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPanggilan $suratPanggilan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        return view('surat_panggilans.show', compact('suratPanggilan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPanggilan $suratPanggilan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $rooms = Room::with('jurusan')->get();
        return view('surat_panggilans.edit', compact('suratPanggilan','rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratPanggilan $suratPanggilan)
    {
        $data = $request->validate([
            'nama_siswa'       => 'required|string|max:255',
            'room_id'         => 'required|exists:rooms,id',
            'nomor_surat'      => 'required|string|max:100|unique:surat_panggilans,nomor_surat,' . $suratPanggilan->id,
            'tanggal_waktu'    => 'required|date',
            'tempat'           => 'required|string|max:255',
            'tujuan'           => 'required|string',
        ]);

        $room = Room::with('jurusan')->findOrFail($data['room_id']);
        $data['jurusan'] = $room->kode_rooms
                        . ' - ' . $room->jurusan->nama_jurusan
                        . ' - ' . $room->tingkatan_rooms;

        $suratPanggilan->update($data);

        return redirect()->route('surat_panggilans.index')
                         ->with('success', 'Surat Panggilan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPanggilan $suratPanggilan)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $suratPanggilan->delete();

        return redirect()->route('surat_panggilans.index')
                         ->with('success', 'Surat Panggilan berhasil dihapus.');
    }
    /**
     * Generate the PDF and stream/download it.
     */
    public function generate($id)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        // Ambil data surat panggilan beserta room/jurusan
        $surat = SuratPanggilan::with('room.jurusan')->findOrFail($id);

        // Data tambahan untuk header/footer
        $nama_kepala_sekolah   = 'Drs. Ahmad Fauzi';         // sesuaikan
        $jabatan_kepala_sekolah = 'Kepala Sekolah';        // sesuaikan

        // Render view menjadi PDF
        $pdf = Pdf::loadView('surat_panggilans.template', [
            'suratPanggilan'          => $surat,
            'nama_kepala_sekolah'     => $nama_kepala_sekolah,
            'jabatan_kepala_sekolah'  => $jabatan_kepala_sekolah,
        ])
        ->setPaper('a4', 'portrait');

        // Download dengan nama file berdasarkan nomor surat
        return $pdf->download('Surat_Panggilan_'.$surat->nomor_surat.'.pdf');
    }
}
