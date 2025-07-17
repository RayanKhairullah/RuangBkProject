<?php

namespace App\Livewire\Student\Biodatas;

use App\Models\Biodata;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class EditBiodata extends Component
{
    use WithFileUploads;

    public ?Biodata $biodata = null;
    public $imagePreview = null;

    public $form = [];

    public function mount(): void
    {
        $this->authorize('update biodata');

        $this->biodata = Auth::user()->biodata;

        if (!$this->biodata) {
            redirect()->route('student.biodatas.index')->send();
            return;
        }

        $this->form = $this->biodata->only([
            'nisn', 'jenis_kelamin', 'room_id', 'tempat_lahir', 'tanggal_lahir',
            'telepon', 'agama', 'alamat_ktp', 'alamat_domisili', 'cita_cita', 'hobi',
            'minat_bakat', 'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'nama_ibu',
            'pekerjaan_ibu', 'no_hp_ibu', 'gol_darah',
        ]);

        $this->form['kode_kelas'] = $this->biodata->room?->kode_rooms ?? '';

        $this->imagePreview = $this->biodata->image;
    }

    public function render()
    {
        return view('livewire.student.biodatas.biodatas-edit', [
            'rooms' => Room::all(),
        ]);
    }

    public function update()
    {
        $validated = $this->validate([
            'form.nisn' => 'required|digits:10',
            'form.jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'form.kode_kelas' => ['required', 'regex:/^[A-Z0-9]{4}$/'],
            'form.tempat_lahir' => 'required|string',
            'form.tanggal_lahir' => 'required|date',
            'form.telepon' => 'required|regex:/^\\+62[0-9]{10,13}$/',
            'form.agama' => 'nullable|string',
            'form.alamat_ktp' => 'nullable|string',
            'form.alamat_domisili' => 'nullable|string',
            'form.cita_cita' => 'nullable|string',
            'form.hobi' => 'nullable|string',
            'form.minat_bakat' => 'nullable|string',
            'form.nama_ayah' => 'nullable|string',
            'form.pekerjaan_ayah' => 'nullable|string',
            'form.no_hp_ayah' => 'required|regex:/^\\+62[0-9]{10,13}$/',
            'form.nama_ibu' => 'nullable|string',
            'form.pekerjaan_ibu' => 'nullable|string',
            'form.no_hp_ibu' => 'required|regex:/^\\+62[0-9]{10,13}$/',
            'form.gol_darah' => 'nullable|string',
            'form.image' => 'nullable|image|max:2048',
        ]);

        $kodeKelas = strtoupper($this->form['kode_kelas']);
        $room = Room::where('kode_rooms', $kodeKelas)->first();

        if (!$room) {
            $this->addError('form.kode_kelas', 'Kode kelas tidak ditemukan.');
            return;
        }

        $validated['form']['room_id'] = $room->id;
        unset($validated['form']['kode_kelas']);

        if (isset($this->form['image'])) {
            $validated['form']['image'] = $this->form['image']->store('biodata', 'public');
        }

        $this->biodata->update($validated['form']);

        session()->flash('success', 'Biodata berhasil diperbarui.');
        return redirect()->route('student.biodatas.view');
    }
    
    public function updatedFormKodeKelas($value)
    {
        // Hanya izinkan huruf dan angka, maksimal 4 karakter, semua huruf besar
        $this->form['kode_kelas'] = strtoupper(preg_replace('/[^A-Z0-9]/i', '', $value));
    }      
}