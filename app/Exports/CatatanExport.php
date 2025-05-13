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
    protected $userId;

    /**
     * Jika $userId = null, export semua catatan.
     * Jika ada, export hanya catatan milik user tersebut.
     */
    public function __construct(?int $userId = null)
    {
        $this->userId = $userId;
    }

    public function collection()
    {
        $query = Catatan::with(['user', 'room.jurusan', 'guru']);

        if ($this->userId !== null) {
            $query->where('user_id', $this->userId);
        }

        return $query->get();
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
        // Thin borders
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
