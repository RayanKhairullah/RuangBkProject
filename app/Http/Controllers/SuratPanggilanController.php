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
    public function index(Request $request)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }

        // Base query with eager loading
        $baseQuery = SuratPanggilan::with('room.jurusan');

        // Define allowed filters and their logic
        $allowedFilters = [
            'nama_siswa'    => fn($q, $v) => $q->whereRaw('LOWER(nama_siswa) LIKE ?', ['%' . mb_strtolower($v) . '%']),
            'room'          => fn($q, $v) => $q->where('room_id', $v),
            'nomor_surat'   => fn($q, $v) => $q->whereRaw('LOWER(nomor_surat) LIKE ?', ['%' . mb_strtolower($v) . '%']),
            'tanggal'       => fn($q, $v) => $q->whereDate('tanggal_waktu', $v),
        ];

        // Apply filters based on request
        foreach ($request->only(array_keys($allowedFilters)) as $filter => $value) {
            if ($value !== null && $value !== '') {
                $baseQuery = $allowedFilters[$filter]($baseQuery, $value);
            }
        }

        $suratPanggilans = $baseQuery->latest()->paginate(10)->withQueryString();

        // Data rooms diperlukan untuk dropdown filter di Blade
        $rooms = Room::with('jurusan')->get();

        return view('surat_panggilans.index', compact('suratPanggilans', 'rooms'));
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
            'nama_siswa'        => 'required|string|max:255',
            'room_id'           => 'required|exists:rooms,id',
            'nomor_surat'       => 'required|string|max:100|unique:surat_panggilans,nomor_surat',
            'tanggal_waktu'     => 'required|date',
            'tempat'            => 'required|string|max:255',
            'tujuan'            => 'required|string',
        ]);

        $room = Room::with('jurusan')->findOrFail($data['room_id']);
        // Kolom 'jurusan' ini tidak ada di tabel, jadi ini hanya untuk data di dalam controller
        // Jika Anda ingin menyimpannya, tambahkan kolom di migrasi dan fillable di model.
        $data['jurusan_display'] = $room->kode_rooms
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
            'nama_siswa'        => 'required|string|max:255',
            'room_id'           => 'required|exists:rooms,id',
            'nomor_surat'       => 'required|string|max:100|unique:surat_panggilans,nomor_surat,' . $suratPanggilan->id,
            'tanggal_waktu'     => 'required|date',
            'tempat'            => 'required|string|max:255',
            'tujuan'            => 'required|string',
        ]);

        $room = Room::with('jurusan')->findOrFail($data['room_id']);
        // Kolom 'jurusan' ini tidak ada di tabel, jadi ini hanya untuk data di dalam controller
        // Jika Anda ingin menyimpannya, tambahkan kolom di migrasi dan fillable di model.
        $data['jurusan_display'] = $room->kode_rooms
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
        $surat = SuratPanggilan::with('room.jurusan')->findOrFail($id);

        $nama_kepala_sekolah    = 'Drs. Ismael Harahap';
        $jabatan_kepala_sekolah = 'Kepala Sekolah';

        $pdf = Pdf::loadView('surat_panggilans.template', [
            'suratPanggilan'        => $surat,
            'nama_kepala_sekolah'   => $nama_kepala_sekolah,
            'jabatan_kepala_sekolah' => $jabatan_kepala_sekolah,
        ])
        ->setPaper('a4', 'portrait');

        // Bersihkan nomor_surat dari karakter yang tidak valid untuk nama file
        $cleanNomorSurat = str_replace(['/', '\\'], '-', $surat->nomor_surat); // Ganti / dan \ dengan -

        return $pdf->download('Surat_Panggilan_'.$cleanNomorSurat.'.pdf');
    }

    /**
     * Stream the PDF for preview in browser. (METODE BARU untuk streaming)
     */
    public function streamPdf($id)
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $surat = SuratPanggilan::with('room.jurusan')->findOrFail($id);

        $nama_kepala_sekolah    = 'Drs. Ismael Harahap';
        $jabatan_kepala_sekolah = 'Kepala Sekolah';

        $pdf = Pdf::loadView('surat_panggilans.template', [
            'suratPanggilan'        => $surat,
            'nama_kepala_sekolah'   => $nama_kepala_sekolah,
            'jabatan_kepala_sekolah' => $jabatan_kepala_sekolah,
        ])
        ->setPaper('a4', 'portrait');

        // Bersihkan nomor_surat dari karakter yang tidak valid untuk nama file
        $cleanNomorSurat = str_replace(['/', '\\'], '-', $surat->nomor_surat); // Ganti / dan \ dengan -

        return $pdf->stream('Surat_Panggilan_'.$cleanNomorSurat.'.pdf'); // Menggunakan stream()
    }

    /**
     * Display a preview page that embeds the PDF. (METODE UTAMA untuk halaman preview)
     */
    public function previewPdfPage($id) // Ganti nama agar tidak bentrok dengan streamPdf
    {
        if (Auth::user()->role !== UserRole::Teacher) {
            abort(403, 'Unauthorized action.');
        }
        $surat = SuratPanggilan::with('room.jurusan')->findOrFail($id);
        // Kita tidak perlu mengirim data surat lengkap ke view ini,
        // karena view ini hanya akan me-load iframe yang URL-nya sudah memiliki ID.
        // Cukup ID saja yang diperlukan untuk membuat URL stream.
        return view('surat_panggilans.pdf-preview', compact('surat')); // Kirim $surat untuk mendapatkan ID
    }
}