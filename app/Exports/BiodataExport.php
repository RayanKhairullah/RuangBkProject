<?php

namespace App\Exports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BiodataExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function collection()
    {
        // Return a collection of one row
        return collect([$this->user->biodata]);
    }

    public function headings(): array
    {
        return [
            'NISN',
            'Name',
            'Email',
            'Jurusan',
            'Room',
            'Telepon',
            'Agama',
            'Alamat',
            'Tanggal Lahir',
            'Golongan Darah',
            'Status',
        ];
    }

    public function map($biodata): array
    {
        return [
            $biodata->nisn,
            $biodata->user->name,
            $biodata->user->email,
            $biodata->jurusan->nama_jurusan,
            $biodata->rooms->tingkatan_rooms,
            $biodata->telepon,
            $biodata->agama,
            $biodata->alamat,
            $biodata->tanggal_lahir instanceof \Carbon\Carbon
                ? $biodata->tanggal_lahir->format('Y-m-d')
                : $biodata->tanggal_lahir,
            $biodata->gol_darah,
            $biodata->status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold headings
        $sheet->getStyle('A1:K1')->getFont()->setBold(true);

        // Autosize columns
        foreach (range('A', 'K') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set border for all cells
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}