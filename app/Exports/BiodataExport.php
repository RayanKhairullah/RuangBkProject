<?php

namespace App\Exports;

use App\Models\Biodata;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Carbon\Carbon;

class BiodataExport implements FromQuery, WithHeadings, WithMapping, WithStyles
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Query to fetch all biodata with related user, jurusan, and room.
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return Biodata::with(['user', 'jurusan', 'room'])
            ->where('user_id', $this->user->id);
    }

    /**
     * Define the headings for all biodata columns.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Nama Siswa',
            'NISN',
            'Jenis Kelamin',
            'Jurusan',
            'Kode Kelas',
            'Tingkatan Kelas',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Telepon',
            'Agama',
            'Alamat KTP',
            'Alamat Domisili',
            'Cita Cita',
            'Hobi',
            'Minat Bakat',
            'SD',
            'SMP',
            'Nama Ayah',
            'Pekerjaan Ayah',
            'No HP Ayah',
            'Nama Ibu',
            'Pekerjaan Ibu',
            'No HP Ibu',
            'Golongan Darah',
            'Status',
            'Image Path',
            'Created At',
            'Updated At',
        ];
    }

    /**
     * Map each biodata record to an exportable row.
     *
     * @param  \App\Models\Biodata  $b
     * @return array
     */
    public function map($b): array
    {
        return [
            $b->id,
            $b->user_id,
            $b->nama_siswa,
            $b->nisn,
            $b->jenis_kelamin,
            optional($b->jurusan)->nama_jurusan,
            optional($b->room)->kode_rooms,
            optional($b->room)->tingkatan_rooms,
            $b->tempat_lahir,
            $b->tanggal_lahir instanceof Carbon
                ? $b->tanggal_lahir->format('Y-m-d')
                : $b->tanggal_lahir,
            $b->telepon,
            $b->agama,
            $b->alamat_ktp,
            $b->alamat_domisili,
            $b->cita_cita,
            $b->hobi,
            $b->minat_bakat,
            $b->sd,
            $b->smp,
            $b->nama_ayah,
            $b->pekerjaan_ayah,
            $b->no_hp_ayah,
            $b->nama_ibu,
            $b->pekerjaan_ibu,
            $b->no_hp_ibu,
            $b->gol_darah,
            $b->status,
            $b->image,
            $b->created_at->format('Y-m-d H:i:s'),
            $b->updated_at->format('Y-m-d H:i:s'),
        ];
    }

    /**
     * Apply styles to the sheet: bold headers, autosize, thin borders.
     *
     * @param  Worksheet  $sheet
     * @return void
     */
    public function styles(Worksheet $sheet)
    {
        // Bold header row
        $sheet->getStyle('A1:AB1')->getFont()->setBold(true);

        // Autosize columns A through AB
        foreach (range('A', 'Z') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        foreach (['AA', 'AB'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Thin borders for all cells
        $highestRow = $sheet->getHighestRow();
        $highestCol = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestCol}{$highestRow}")
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
