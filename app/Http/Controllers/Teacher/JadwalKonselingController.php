<?php

namespace App\Http\Controllers\Teacher;

use App\Models\JadwalKonseling;
use App\Exports\JadwalKonselingExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;

class JadwalKonselingController
{
    public function acceptAndRedirectToCalendar(JadwalKonseling $jadwal)
    {
        if (Auth::id() !== $jadwal->penerima_id) {
            abort(403);
        }

        $jadwal->update(['status' => 'accepted']);

        $start = Carbon::parse($jadwal->tanggal)->format('Ymd\THis\Z');
        $end = Carbon::parse($jadwal->tanggal)->addHour()->format('Ymd\THis\Z');

        $url = 'https://www.google.com/calendar/render?action=TEMPLATE'
            . '&text=' . urlencode('Konseling: ' . $jadwal->topik_dibahas)
            . '&dates=' . $start . '/' . $end
            . '&details=' . urlencode("Lokasi: {$jadwal->lokasi}\nTopik: {$jadwal->topik_dibahas}")
            . '&location=' . urlencode($jadwal->lokasi)
            . '&sf=true&output=xml';

        return Redirect::away($url);
    }

    public function showRejectForm(JadwalKonseling $jadwal)
    {
        if (Auth::id() !== $jadwal->penerima_id) {
            abort(403);
        }

        return view('livewire.teacher.jadwal-konselings.reject-form', compact('jadwal'));
    }

    // Menyimpan alasan penolakan
    public function reject(Request $request, JadwalKonseling $jadwal)
    {
        if (Auth::id() !== $jadwal->penerima_id) {
            abort(403);
        }

        $request->validate([
            'alasan_penolakan' => 'required|string|min:3'
        ]);

        $jadwal->update([
            'status' => 'rejected',
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        return redirect()->route('teacher.jadwal-konselings.index')
            ->with('success', 'Jadwal ditolak dengan alasan.');
    }
    
    /**
     * Export jadwal konseling to Excel
     */
    public function export(Request $request)
    {
        return Excel::download(new JadwalKonselingExport, 'jadwal_konseling.xlsx');
    }
}
