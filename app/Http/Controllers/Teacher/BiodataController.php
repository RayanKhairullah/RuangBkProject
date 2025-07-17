<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Biodata;
use App\Exports\BiodataExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BiodataController
{
    public function exportPdf($id)
    {
        $biodata = Biodata::with('user', 'room.jurusan')->findOrFail($id);
        // Pastikan user yang mengakses adalah pemilik data atau admin/guru
        if (auth()->user()->cannot('view biodata student', $biodata) && !auth()->user()->hasRole(['teacher'])) {
            abort(403, 'Unauthorized action.');
        }
        $pdf = PDF::loadView('exports.biodata', compact('biodata'));
        return $pdf->download('biodata-' . $biodata->user->name . '.pdf');
    }

    // PDF Preview for embedding
    public function previewPdf($id)
    {
        $biodata = Biodata::with('user', 'room.jurusan')->findOrFail($id);
        if (auth()->user()->cannot('view biodata student', $biodata) && !auth()->user()->hasRole(['teacher'])) {
            abort(403, 'Unauthorized action.');
        }
        $pdf = PDF::loadView('exports.biodata', compact('biodata'));
        
        // Set headers for inline display
        return $pdf->stream('biodata-' . $biodata->user->name . '.pdf', [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="biodata-' . $biodata->user->name . '.pdf"'
        ]);
    }
}
