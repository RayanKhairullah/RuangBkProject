<x-layouts.app :title="__('Biodata of ') . $user->name">
    <div class="mb-4">
        <a href="{{ route('users.index') }}"
           class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-full font-semibold shadow transition text-sm">
            &larr; {{ __('Kembali ke Daftar User') }}
        </a>
    </div>

    <div class="relative">
        <!-- Decorative Corners -->
        <div class="absolute top-0 left-0 w-28 h-28 bg-yellow-400 dark:bg-yellow-600 rounded-br-2xl"></div>
        <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-400 dark:bg-indigo-700 rounded-bl-2xl"></div>
        <div class="absolute bottom-0 left-0 w-28 h-28 bg-indigo-400 dark:bg-indigo-700 rounded-tr-2xl"></div>
        <div class="absolute bottom-0 right-0 w-28 h-28 bg-yellow-400 dark:bg-yellow-600 rounded-tl-2xl"></div>

        <main class="min-h-screen flex items-center justify-center px-4 md:px-10 bg-white dark:bg-gray-900 pt-16 pb-16">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-7xl w-full p-6 md:p-12 z-10 border border-indigo-100 dark:border-indigo-800">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-orange-500 dark:text-orange-300 mb-4 md:mb-0">
                        {{ __('Biodata ') . $user->name }}
                    </h1>
                </div>

                <div class="flex flex-col md:flex-row gap-8">
                    <!-- Data section -->
                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-3 gap-y-4 text-gray-800 dark:text-gray-200 text-sm md:text-base">
                            <div class="font-semibold">{{ __('NISN') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->nisn }}</div>

                            <div class="font-semibold">{{ __('Nama Siswa') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->nama_siswa }}</div>

                            <div class="font-semibold">{{ __('Jenis Kelamin') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->jenis_kelamin }}</div>

                            <div class="font-semibold">{{ __('Kode Kelas') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->room->kode_rooms }}</div>

                            <div class="font-semibold">{{ __('Jurusan') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->room->jurusan->nama_jurusan }}</div>

                            <div class="font-semibold">{{ __('Kelas') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->room->tingkatan_rooms }}</div>

                            <div class="font-semibold">{{ __('Telepon') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->telepon }}</div>

                            <div class="font-semibold">{{ __('Agama') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->agama }}</div>

                            <div class="font-semibold">{{ __('Alamat KTP') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->alamat_ktp }}</div>

                            <div class="font-semibold">{{ __('Alamat Domisili') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->alamat_domisili ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Tanggal Lahir') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->tanggal_lahir }}</div>

                            <div class="font-semibold">{{ __('Golongan Darah') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->gol_darah }}</div>

                            <div class="font-semibold">{{ __('Status') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->status }}</div>

                            <div class="font-semibold">{{ __('Cita-cita') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->cita_cita ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Hobi') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->hobi ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Minat & Bakat') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->minat_bakat ?? '-' }}</div>

                            <div class="font-semibold">{{ __('SD') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->sd ?? '-' }}</div>

                            <div class="font-semibold">{{ __('SMP') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->smp ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Nama Ayah') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->nama_ayah ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Pekerjaan Ayah') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->pekerjaan_ayah ?? '-' }}</div>

                            <div class="font-semibold">{{ __('No HP Ayah') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->no_hp_ayah ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Nama Ibu') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->nama_ibu ?? '-' }}</div>

                            <div class="font-semibold">{{ __('Pekerjaan Ibu') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->pekerjaan_ibu ?? '-' }}</div>

                            <div class="font-semibold">{{ __('No HP Ibu') }}</div>
                            <div class="font-light">:</div>
                            <div>{{ $biodata->no_hp_ibu ?? '-' }}</div>
                        </div>
                    </div>

                    <!-- Image section -->
                    <div class="w-full md:w-1/3 flex justify-center md:justify-end items-start mt-4 md:mt-0">
                        @if($biodata->image)
                            <div class="w-40 h-auto sm:w-52 sm:h-auto bg-gray-100 dark:bg-gray-700 flex items-center justify-center rounded-xl shadow p-2 border border-indigo-100 dark:border-indigo-800">
                                <img src="{{ asset('storage/' . $biodata->image) }}"
                                     alt="Foto Siswa"
                                     class="max-w-full max-h-60 object-contain rounded">
                            </div>
                        @else
                            <div class="w-40 h-52 sm:w-48 sm:h-60 bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-300 flex items-center justify-center rounded-xl text-sm border border-indigo-100 dark:border-indigo-800">
                                Foto Siswa
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layouts.app>