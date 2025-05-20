<x-layouts.app :title="__('Biodata of ') . $user->name">
<div class="mb-4">
  <a href="{{ route('users.index') }}"
     class="inline-block px-5 py-2 rounded-md
            bg-blue-600 text-white font-semibold
            hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1
            transition
            dark:bg-blue-500 dark:hover:bg-blue-600"
  >
    {{ __('Back to Users') }}
  </a>
</div>

  <div class="relative">
    <div class="absolute top-0 left-0 w-28 h-28 bg-yellow-400 rounded-br-2xl"></div>
    <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-400 rounded-bl-2xl"></div>
    <div class="absolute bottom-0 left-0 w-28 h-28 bg-indigo-400 rounded-tr-2xl"></div>
    <div class="absolute bottom-0 right-0 w-28 h-28 bg-yellow-400 rounded-tl-2xl"></div>

    <main class="min-h-screen flex items-center justify-center px-4 md:px-10 bg-white pt-16 pb-16">
      <div class="bg-white rounded-xl shadow-xl max-w-7xl w-full p-6 md:p-12 z-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 md:mb-8">
          <h1 class="text-2xl md:text-3xl text-black mb-4 md:mb-0">{{ __('Biodata '). $user->name}}</h1>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
          <!-- Data section -->
          <div class="w-full md:w-2/3">
            <div class="grid grid-cols-3 gap-y-4 text-gray-800 text-sm md:text-base">
              <div class="font-normal">{{ __('NISN') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->nisn }}</div>
                            <!-- Seluruh data lain tetap sama -->
              <div class="font-normal">{{ __('Nama Siswa') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->nama_siswa }}</div>

              <div class="font-normal">{{ __('Jenis Kelamin') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->jenis_kelamin }}</div>

              <div class="font-normal">{{ __('Kode Kelas') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->room->kode_rooms }}</div>

              <div class="font-normal">{{ __('Jurusan') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->room->jurusan->nama_jurusan }}</div>

              <div class="font-normal">{{ __('Kelas') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->room->tingkatan_rooms }}</div>

              <div class="font-normal">{{ __('Telepon') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->telepon }}</div>

              <div class="font-normal">{{ __('Agama') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->agama }}</div>

              <div class="font-normal">{{ __('Alamat KTP') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->alamat_ktp }}</div>

              <div class="font-normal">{{ __('Alamat Domisili') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->alamat_domisili ?? '-' }}</div>

              <div class="font-normal">{{ __('Tanggal Lahir') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->tanggal_lahir }}</div>

              <div class="font-normal">{{ __('Golongan Darah') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->gol_darah }}</div>

              <div class="font-normal">{{ __('Status') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->status }}</div>

              <div class="font-normal">{{ __('Cita-cita') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->cita_cita ?? '-' }}</div>

              <div class="font-normal">{{ __('Hobi') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->hobi ?? '-' }}</div>

              <div class="font-normal">{{ __('Minat & Bakat') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->minat_bakat ?? '-' }}</div>

              <div class="font-normal">{{ __('SD') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->sd ?? '-' }}</div>

              <div class="font-normal">{{ __('SMP') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->smp ?? '-' }}</div>

              <div class="font-normal">{{ __('Nama Ayah') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->nama_ayah ?? '-' }}</div>

              <div class="font-normal">{{ __('Pekerjaan Ayah') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->pekerjaan_ayah ?? '-' }}</div>

              <div class="font-normal">{{ __('No HP Ayah') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->no_hp_ayah ?? '-' }}</div>

              <div class="font-normal">{{ __('Nama Ibu') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->nama_ibu ?? '-' }}</div>

              <div class="font-normal">{{ __('Pekerjaan Ibu') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->pekerjaan_ibu ?? '-' }}</div>

              <div class="font-normal">{{ __('No HP Ibu') }}</div>
              <div class="font-light">:</div>
              <div class="font-normal">{{ $biodata->no_hp_ibu ?? '-' }}</div>
            </div>
          </div>

          <!-- Image section -->
          <div class="w-full md:w-1/3 flex justify-center md:justify-end items-start mt-4 md:mt-0">
            @if($biodata->image)
              <div class="w-40 h-auto sm:w-50 sm:h-auto bg-gray-100 flex items-center justify-center rounded shadow p-2">
                <img src="{{ asset('storage/' . $biodata->image) }}"
                     alt="Foto Siswa"
                     class="max-w-full max-h-60 object-contain">
              </div>
            @else
              <div class="w-40 h-52 sm:w-48 sm:h-60 bg-gray-200 text-gray-500 flex items-center justify-center rounded text-sm">
                Foto Siswa
              </div>
            @endif
          </div>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>