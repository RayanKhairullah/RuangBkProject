<?php

namespace App\Exports;

use App\Models\PenjadwalanKonseling;
use Maatwebsite\Excel\Concerns\FromCollection;      // Load collection :contentReference[oaicite:3]{index=3}
use Maatwebsite\Excel\Concerns\WithHeadings;        // Header row :contentReference[oaicite:4]{index=4}
use Maatwebsite\Excel\Concerns\WithMapping;         // Map each row :contentReference[oaicite:5]{index=5}
use Maatwebsite\Excel\Concerns\WithStyles;          // Worksheet styling :contentReference[oaicite:6]{index=6}
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PenjadwalanKonselingExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        // Ambil semua jadwal dengan relasi pengirim & penerima
        return PenjadwalanKonseling::with(['pengirim', 'penerima'])->get(); 
    }

    public function headings(): array
    {
        return [
            'Pengirim',        // Nama guru/user yang mengirim
            'Penerima',        // Nama penerima konseling
            'Lokasi',          // Lokasi sesi
            'Tanggal',         // Tanggal & waktu :contentReference[oaicite:7]{index=7}
            'Topik Dibahas',   // Topik diskusi
            'Solusi',          // (Kosong jika belum diisi guru)
            'Status',          // Complete / Incomplete
        ];
    }

    public function map($jadwal): array
    {
        return [
            $jadwal->pengirim->name,
            $jadwal->penerima->name,
            $jadwal->lokasi,
            // Pastikan kolom tanggal di-cast ke Carbon untuk format
            $jadwal->tanggal instanceof \Carbon\Carbon
                ? $jadwal->tanggal->format('Y-m-d H:i')
                : $jadwal->tanggal,
            $jadwal->topik_dibahas,
            $jadwal->solusi,
            $jadwal->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // 1. Bold header row A1:G1
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);

        // 2. Auto-size setiap kolom A–G :contentReference[oaicite:8]{index=8}
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // 3. Thin border di seluruh area data
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
