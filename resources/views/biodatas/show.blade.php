<x-layouts.app :title="__('Biodata')">
  <div class="relative min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800">
    <!-- Sudut dekorasi -->
    <div class="absolute top-0 left-0 w-28 h-28 bg-yellow-400 dark:bg-yellow-600 rounded-br-2xl opacity-70"></div>
    <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-400 dark:bg-indigo-700 rounded-bl-2xl opacity-70"></div>
    <div class="absolute bottom-0 left-0 w-28 h-28 bg-indigo-400 dark:bg-indigo-700 rounded-tr-2xl opacity-70"></div>
    <div class="absolute bottom-0 right-0 w-28 h-28 bg-yellow-400 dark:bg-yellow-600 rounded-tl-2xl opacity-70"></div>

    <main class="flex items-center justify-center px-4 md:px-10 pt-16 pb-16 min-h-screen relative z-10">
      <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-indigo-100 dark:border-indigo-800 max-w-4xl w-full p-6 md:p-12">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
          <h1 class="text-2xl md:text-3xl font-bold text-orange-500 dark:text-orange-300 mb-4 md:mb-0 tracking-tight">{{ __('Biodata Siswa') }}</h1>
          <a href="{{ route('biodatas.edit', $biodata->id) }}"
             class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-semibold shadow transition">
            {{ __('Edit Biodata') }}
          </a>
        </div>

        <div class="flex flex-col md:flex-row gap-8">
          <!-- Data section -->
          <div class="w-full md:w-2/3 space-y-8">
            <!-- Data Utama -->
            <div>
              <h2 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-3">Data Utama</h2>
              <div class="grid grid-cols-3 gap-y-3 text-gray-800 dark:text-gray-200 text-sm md:text-base">
                <div class="font-medium">NISN</div><div>:</div><div>{{ $biodata->nisn }}</div>
                <div class="font-medium">Nama Siswa</div><div>:</div><div>{{ $biodata->nama_siswa }}</div>
                <div class="font-medium">Jenis Kelamin</div><div>:</div><div>{{ $biodata->jenis_kelamin }}</div>
                <div class="font-medium">Kode Kelas</div><div>:</div><div>{{ $biodata->room->kode_rooms }}</div>
                <div class="font-medium">Jurusan</div><div>:</div><div>{{ $biodata->room->jurusan->nama_jurusan }}</div>
                <div class="font-medium">Kelas</div><div>:</div><div>{{ $biodata->room->tingkatan_rooms }}</div>
                <div class="font-medium">Telepon</div><div>:</div><div>{{ $biodata->telepon }}</div>
                <div class="font-medium">Agama</div><div>:</div><div>{{ $biodata->agama }}</div>
                <div class="font-medium">Tanggal Lahir</div><div>:</div><div>{{ $biodata->tanggal_lahir }}</div>
                <div class="font-medium">Golongan Darah</div><div>:</div><div>{{ $biodata->gol_darah }}</div>
                <div class="font-medium">Status</div><div>:</div><div>{{ $biodata->status }}</div>
              </div>
            </div>
            <hr class="my-2 border-indigo-100 dark:border-indigo-800">

            <!-- Data Pribadi -->
            <div>
              <h2 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-3">Data Pribadi</h2>
              <div class="grid grid-cols-3 gap-y-3 text-gray-800 dark:text-gray-200 text-sm md:text-base">
                <div class="font-medium">Alamat KTP</div><div>:</div><div>{{ $biodata->alamat_ktp }}</div>
                <div class="font-medium">Alamat Domisili</div><div>:</div><div>{{ $biodata->alamat_domisili ?? '-' }}</div>
                <div class="font-medium">Cita-cita</div><div>:</div><div>{{ $biodata->cita_cita ?? '-' }}</div>
                <div class="font-medium">Hobi</div><div>:</div><div>{{ $biodata->hobi ?? '-' }}</div>
                <div class="font-medium">Minat & Bakat</div><div>:</div><div>{{ $biodata->minat_bakat ?? '-' }}</div>
              </div>
            </div>
            <hr class="my-2 border-indigo-100 dark:border-indigo-800">

            <!-- Riwayat Pendidikan -->
            <div>
              <h2 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-3">Riwayat Pendidikan</h2>
              <div class="grid grid-cols-3 gap-y-3 text-gray-800 dark:text-gray-200 text-sm md:text-base">
                <div class="font-medium">SD</div><div>:</div><div>{{ $biodata->sd ?? '-' }}</div>
                <div class="font-medium">SMP</div><div>:</div><div>{{ $biodata->smp ?? '-' }}</div>
              </div>
            </div>
            <hr class="my-2 border-indigo-100 dark:border-indigo-800">

            <!-- Data Orang Tua -->
            <div>
              <h2 class="text-lg font-semibold text-indigo-700 dark:text-indigo-300 mb-3">Data Orang Tua</h2>
              <div class="grid grid-cols-3 gap-y-3 text-gray-800 dark:text-gray-200 text-sm md:text-base">
                <div class="font-medium">Nama Ayah</div><div>:</div><div>{{ $biodata->nama_ayah ?? '-' }}</div>
                <div class="font-medium">Pekerjaan Ayah</div><div>:</div><div>{{ $biodata->pekerjaan_ayah ?? '-' }}</div>
                <div class="font-medium">No HP Ayah</div><div>:</div><div>{{ $biodata->no_hp_ayah ?? '-' }}</div>
                <div class="font-medium">Nama Ibu</div><div>:</div><div>{{ $biodata->nama_ibu ?? '-' }}</div>
                <div class="font-medium">Pekerjaan Ibu</div><div>:</div><div>{{ $biodata->pekerjaan_ibu ?? '-' }}</div>
                <div class="font-medium">No HP Ibu</div><div>:</div><div>{{ $biodata->no_hp_ibu ?? '-' }}</div>
              </div>
            </div>
          </div>

          <!-- Image section -->
          <div class="w-full md:w-1/3 flex justify-center md:justify-end items-start mt-4 md:mt-0">
            @if($biodata->image)
              <div class="w-44 h-60 bg-gray-50 dark:bg-gray-700 flex items-center justify-center rounded-xl shadow border border-indigo-100 dark:border-indigo-800 hover:shadow-lg transition">
                <img src="{{ asset('storage/' . $biodata->image) }}"
                     alt="Foto Siswa"
                     class="max-w-full max-h-56 object-contain rounded-lg" />
              </div>
            @else
              <div class="w-44 h-60 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-300 flex items-center justify-center rounded-xl text-sm border border-dashed border-gray-400 dark:border-gray-600">
                Foto Siswa
              </div>
            @endif
          </div>
        </div>
      </div>
    </main>
  </div>
</x-layouts.app>