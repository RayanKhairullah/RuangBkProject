<?php

namespace App\Exports;

use App\Models\Catatan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CatatanExport implements FromView
{
    protected $catatans;

    public function __construct($catatans)
    {
        $this->catatans = $catatans;
    }

    public function view(): View
    {
        // Pastikan eager loading relasi yang dibutuhkan
        $catatans = $this->catatans;
        if (method_exists($catatans, 'load')) {
            $catatans->load(['siswa', 'guru', 'room.jurusan']);
        }
        return view('exports.catatans', [
            'catatans' => $catatans
        ]);
    }
}
