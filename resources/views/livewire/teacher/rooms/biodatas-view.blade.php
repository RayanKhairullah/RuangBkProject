<section class="w-full max-w-4xl mx-auto">
    <x-page-heading>
        <x-slot:title>Detail Biodata</x-slot:title>
        <x-slot:subtitle>Berikut adalah informasi biodata yang telah kamu isi</x-slot:subtitle>
    </x-page-heading>

    <div class="relative">
        <div class="absolute top-0 left-0 w-28 h-28 bg-yellow-400 rounded-br-2xl"></div>
        <div class="absolute top-0 right-0 w-28 h-28 bg-indigo-400 rounded-bl-2xl"></div>
        <div class="absolute bottom-0 left-0 w-28 h-28 bg-indigo-400 rounded-tr-2xl"></div>
        <div class="absolute bottom-0 right-0 w-28 h-28 bg-yellow-400 rounded-tl-2xl"></div>

        <main class="min-h-screen flex items-center justify-center px-4 md:px-10 bg-white pt-16 pb-16">
            <div class="bg-white rounded-xl shadow-xl max-w-7xl w-full p-6 md:p-12 z-10">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 md:mb-8">
                    <h1 class="text-2xl md:text-3xl text-black mb-4 md:mb-0">{{ __('Biodata ') . $biodata->user->name ?? '-' }}</h1>
                    <a href="{{ url()->previous() }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Kembali</a>
                </div>

                <div class="flex flex-col md:flex-row gap-6">
                    <!-- Data section -->
                    <div class="w-full md:w-2/3">
                        <div class="grid grid-cols-3 gap-y-4 text-gray-800 text-sm md:text-base">
                            <div class="font-normal">NISN</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->nisn }}</div>
                            <div class="font-normal">Nama Siswa</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->user->name }}</div>
                            <div class="font-normal">Jenis Kelamin</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->jenis_kelamin }}</div>
                            <div class="font-normal">Kode Kelas</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->room->kode_rooms }}</div>
                            <div class="font-normal">Jurusan</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->room->jurusan->nama_jurusan }}</div>
                            <div class="font-normal">Kelas</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->room->tingkatan_rooms }}</div>
                            <div class="font-normal">Telepon</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->telepon }}</div>
                            <div class="font-normal">Agama</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->agama }}</div>
                            <div class="font-normal">Alamat KTP</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->alamat_ktp }}</div>
                            <div class="font-normal">Alamat Domisili</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->alamat_domisili ?? '-' }}</div>
                            <div class="font-normal">Tanggal Lahir</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->tanggal_lahir }}</div>
                            <div class="font-normal">Golongan Darah</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->gol_darah }}</div>
                            <div class="font-normal">Cita-cita</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->cita_cita ?? '-' }}</div>
                            <div class="font-normal">Hobi</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->hobi ?? '-' }}</div>
                            <div class="font-normal">Minat & Bakat</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->minat_bakat ?? '-' }}</div>
                            <div class="font-normal">Nama Ayah</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->nama_ayah ?? '-' }}</div>
                            <div class="font-normal">Pekerjaan Ayah</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->pekerjaan_ayah ?? '-' }}</div>
                            <div class="font-normal">No HP Ayah</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->no_hp_ayah ?? '-' }}</div>
                            <div class="font-normal">Nama Ibu</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->nama_ibu ?? '-' }}</div>
                            <div class="font-normal">Pekerjaan Ibu</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->pekerjaan_ibu ?? '-' }}</div>
                            <div class="font-normal">No HP Ibu</div><div class="font-light">:</div><div class="font-normal">{{ $biodata->no_hp_ibu ?? '-' }}</div>
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
</section>