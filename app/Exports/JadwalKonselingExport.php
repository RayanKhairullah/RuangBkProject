<?php

namespace App\Exports;

use App\Models\JadwalKonseling;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JadwalKonselingExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return JadwalKonseling::with('pengirim')
            ->where('penerima_id', Auth::id())
            ->get()
            ->map(function ($jadwal) {
                return [
                    'ID' => $jadwal->id,
                    'Nama Pengirim' => $jadwal->pengirim->name ?? 'Tidak Diketahui',
                    'Lokasi' => $jadwal->lokasi,
                    'Tanggal' => $jadwal->tanggal,
                    'Topik Dibahas' => $jadwal->topik_dibahas,
                    'Solusi' => $jadwal->solusi ?? '-',
                    'Status' => $jadwal->status,
                    'Alasan Penolakan' => in_array($jadwal->status, ['pending', 'accepted']) 
                        ? '-' 
                        : ($jadwal->alasan_penolakan ?? '-'),
                    'Dibuat Pada' => $jadwal->created_at->format('Y-m-d H:i:s'),
                    'Diupdate Pada' => $jadwal->updated_at->format('Y-m-d H:i:s'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Pengirim',
            'Lokasi',
            'Tanggal',
            'Topik Dibahas',
            'Solusi',
            'Status',
            'Alasan Penolakan',
            'Dibuat Pada',
            'Diupdate Pada',
        ];
    }
}
