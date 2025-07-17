<?php

namespace App\Livewire\Student\Biodatas;

use App\Models\Biodata;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

class ViewBiodata extends Component
{
    public ?Biodata $biodata;

    #[Layout('components.layouts.student')]
    public function render(): View
    {
        $this->authorize('view biodata');

        $user = Auth::user();
        $this->biodata = $user->biodata;

        return view('livewire.student.biodatas.biodatas-view', [
            'biodata' => $this->biodata,
        ]);
    }

    /**
     * Mendapatkan tahun pendidikan berdasarkan tingkat
     */
    public function getTahunPendidikan($tingkat): string
    {
        $tahunSekarang = now()->year;
        $bulanSekarang = now()->month;
        
        // Jika saat ini masih semester ganjil (Januari-Juni), kurangi 1 tahun
        $tahunAjaran = $bulanSekarang <= 6 ? $tahunSekarang - 1 : $tahunSekarang;
        
        $tingkatMap = [
            'SD' => 6,
            'SMP' => 3,
            'SMA' => 3,
            'SMK' => 3,
            'MA' => 3,
        ];
        
        if (isset($tingkatMap[$tingkat])) {
            $tahunMulai = $tahunAjaran - $tingkatMap[$tingkat] + 1;
            return "$tahunMulai - $tahunAjaran";
        }
        
        return 'Tahun tidak diketahui';
    }
}