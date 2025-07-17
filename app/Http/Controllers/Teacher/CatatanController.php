<?php

namespace App\Http\Controllers\Teacher;

use App\Exports\CatatanExport;
use App\Models\Catatan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CatatanController
{
    // Export semua catatan
    public function exportAll(Request $request)
    {
        $catatans = Catatan::with(['siswa', 'guru'])->get();
        return Excel::download(new CatatanExport($catatans), 'catatan-semua.xlsx');
    }

    // Export semua catatan berdasarkan user_id (siswa)
    public function exportByUser($user_id)
    {
        $catatans = Catatan::with(['siswa', 'guru'])->where('user_id', $user_id)->get();
        return Excel::download(new CatatanExport($catatans), 'catatan-siswa-' . $user_id . '.xlsx');
    }
}
