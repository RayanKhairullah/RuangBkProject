<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\SuratPanggilan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPanggilanController extends Controller
{
    // Download PDF
    public function exportPdf($id)
    {
        $surat = SuratPanggilan::with(['biodata.user', 'room'])->findOrFail($id);
        $pdf = Pdf::loadView('exports.surat-panggilan', compact('surat'));
        $safeNomor = str_replace(['/', '\\'], '-', $surat->nomor_surat);
        return $pdf->download('surat-panggilan-'.$safeNomor.'.pdf');
    }

    // Preview PDF (embed)
    public function previewPdf($id)
    {
        $surat = SuratPanggilan::with(['biodata.user', 'room'])->findOrFail($id);
        $pdf = Pdf::loadView('exports.surat-panggilan', compact('surat'));
        $safeNomor = str_replace(['/', '\\'], '-', $surat->nomor_surat);
        return $pdf->stream('surat-panggilan-'.$safeNomor.'.pdf');
    }
}
