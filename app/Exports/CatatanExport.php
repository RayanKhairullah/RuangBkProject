<?php

namespace App\Exports;

use App\Models\Catatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CatatanExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        // Ambil semua catatan dengan relasi
        return Catatan::with(['user', 'room.jurusan', 'guru'])->get();
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Jurusan',
            'Tingkatan Kelas',
            'Kasus',
            'Tanggal',
            'Nama Guru',
            'Catatan Guru',
            'Poin',
        ];
    }

    public function map($catatan): array
    {
        return [
            $catatan->user->name,
            $catatan->room->jurusan->nama_jurusan,
            $catatan->room->tingkatan_rooms,
            $catatan->kasus,
            $catatan->tanggal instanceof \Carbon\Carbon
                ? $catatan->tanggal->format('Y-m-d')
                : $catatan->tanggal,
            $catatan->guru->name,
            $catatan->catatan_guru,
            $catatan->poin,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold header row
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        // Autosize columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Add thin borders
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
