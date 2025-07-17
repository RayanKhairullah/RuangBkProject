<?php

namespace App\Exports;

use App\Models\Biodata;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class BiodataExport implements FromView, ShouldAutoSize, WithTitle
{
    protected $biodata;

    public function __construct(Biodata $biodata)
    {
        $this->biodata = $biodata;
    }

    public function view(): View
    {
        return view('exports.biodata', [
            'biodata' => $this->biodata
        ]);
    }

    public function title(): string
    {
        return 'Biodata_' . $this->biodata->user->name;
    }
}
