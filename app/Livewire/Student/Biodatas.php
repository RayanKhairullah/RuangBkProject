<?php

namespace App\Livewire\Student;

use App\Models\Biodata;
use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student')]
class Biodatas extends Component
{
    use WithFileUploads;

    public ?Biodata $biodata = null;
    public $imagePreview = null;


    public $form = [
        'jenis_kelamin' => '',
        'nisn' => '',
        'kode_kelas' => '',
        'tempat_lahir' => '',
        'tanggal_lahir' => '',
        'telepon' => '',
        'agama' => '',
        'alamat_ktp' => '',
        'alamat_domisili' => '',
        'cita_cita' => '',
        'hobi' => '',
        'minat_bakat' => '',
        'nama_ayah' => '',
        'pekerjaan_ayah' => '',
        'no_hp_ayah' => '',
        'nama_ibu' => '',
        'pekerjaan_ibu' => '',
        'no_hp_ibu' => '',
        'gol_darah' => '',
        'image' => null,
    ];

    public function mount(): void
    {
        $this->authorize('view biodata');

        $user = Auth::user();
        $this->biodata = $user->biodata;

        // Perform the redirect directly in mount()
        if ($this->biodata) {
            redirect()->route('student.biodatas.view');
            return; // Important: Stop further execution of mount()
        }
    }

    public function render(): View
    {
        $rooms = Room::all();

        return view('livewire.student.biodatas', [
            'biodata' => $this->biodata,
            'rooms' => $rooms,
        ]);
    }

    public function save()
    {
        $user = Auth::user();

        $this->authorize('create biodata');

        if ($user->biodata) {
            session()->flash('error', 'Biodata sudah ada. Silakan update biodata Anda.');
            return redirect()->route('student.biodatas.view');
        }

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

        // Cari room berdasarkan kode_kelas
        $kodeKelas = strtoupper($this->form['kode_kelas']);
        $room = Room::where('kode_rooms', $kodeKelas)->first();

        if (!$room) {
            $this->addError('form.kode_kelas', 'Kode kelas tidak ditemukan.');
            return;
        }

        $data = $validated['form'];
        $data['user_id'] = $user->id;
        $data['room_id'] = $room->id;
        $data['jurusan_id'] = $room->jurusan_id;
        unset($data['kode_kelas']);

        if ($this->form['image']) {
            $data['image'] = $this->form['image']->store('biodata', 'public');
        }

        $this->biodata = Biodata::create($data);

        session()->flash('success', 'Biodata berhasil disimpan.');
        return redirect()->route('student.biodatas.view');
    }

    public function updatedFormKodeKelas($value)
    {
        // Hanya izinkan huruf dan angka, maksimal 4 karakter, semua huruf besar
        $this->form['kode_kelas'] = strtoupper(preg_replace('/[^A-Z0-9]/i', '', $value));
    }
}