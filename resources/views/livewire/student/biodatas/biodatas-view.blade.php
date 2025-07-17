<section class="w-full max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-white-900">Detail Biodata</h1>
            <p class="mt-1 text-sm text-gray-600">Informasi lengkap data pribadi *Jaga baik-baik</p>
        </div>
        <a href="{{ route('student.biodatas.edit') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit Biodata
        </a>
    </div>

    <!-- Main Content -->
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="p-6 sm:px-10">
            <!-- Profile Header -->
            <div class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6 pb-6 border-b">
                <!-- Profile Image -->
                <div class="flex-shrink-0">
                    @if($biodata->image)
                        <img class="h-32 w-32 rounded-full object-cover border-4 border-white shadow" 
                             src="{{ asset('storage/' . $biodata->image) }}" 
                             alt="{{ $biodata->user->name }}">
                    @else
                        <div class="h-32 w-32 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                            <svg class="h-16 w-16" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>
                
                <!-- Basic Info -->
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900">{{ $biodata->user->name }}</h2>
                    <div class="mt-1 text-sm text-gray-600">
                        <span class="inline-flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-1.386 5.5 5.5 0 011.25-7.24l1.24-1.26a1 1 0 011.42 0l1.24 1.26a5.5 5.5 0 011.25 7.24 1 1 0 01-.89 1.386 8.969 8.969 0 00-1.05.174V10.12l1.69-.724a7.5 7.5 0 00-1.1 3.706c0 .427.03.85.086 1.267a1 1 0 01-1.99.2 5.5 5.5 0 01-4.25-5.87z" />
                            </svg>
                            {{ $biodata->room->kode_rooms }} - {{ $biodata->room->tingkatan_rooms }} {{ $biodata->room->jurusan->nama_jurusan }}
                        </span>
                    </div>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                            </svg>
                            {{ $biodata->tanggal_lahir }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                            </svg>
                            {{ $biodata->agama }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <svg class="h-3 w-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            {{ $biodata->gol_darah }}
                        </span>
                    </div>
                </div>
                
                <!-- Contact Info -->
                <div class="w-full md:w-1/3 bg-gray-50 p-4 rounded-lg">
                    <h3 class="text-sm font-medium text-gray-500">Kontak</h3>
                    <div class="mt-2 space-y-1 text-sm">
                        <div class="flex items-center text-gray-600">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $biodata->telepon }}
                        </div>
                        <div class="flex items-center text-gray-600">
                            <svg class="h-4 w-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $biodata->user->email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Informasi Pribadi</h3>
                    <dl class="space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">NISN</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->nisn }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Jenis Kelamin</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->jenis_kelamin }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Tempat, Tgl Lahir</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->tempat_lahir }}, {{ $biodata->tanggal_lahir }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Agama</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->agama }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Gol. Darah</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->gol_darah ?? '-' }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Cita-cita</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->cita_cita ?? '-' }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Hobi</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->hobi ?? '-' }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Minat & Bakat</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->minat_bakat ?? '-' }}</dd>
                        </div>
                    </dl>
                </div>

                <!-- Address Information -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mb-4">Alamat</h3>
                    <dl class="space-y-4">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Alamat KTP</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->alamat_ktp }}</dd>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="text-sm font-medium text-gray-500">Alamat Domisili</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $biodata->alamat_domisili ?? 'Sama dengan alamat KTP' }}</dd>
                        </div>
                    </dl>

                    <!-- Parent Information -->
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2 mt-8 mb-4">Data Orang Tua</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Ayah -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Ayah</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-xs text-gray-500">Nama</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->nama_ayah ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Pekerjaan</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->pekerjaan_ayah ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">No. HP</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->no_hp_ayah ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                        
                        <!-- Ibu -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-medium text-gray-900 mb-2">Ibu</h4>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-xs text-gray-500">Nama</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->nama_ibu ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">Pekerjaan</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->pekerjaan_ibu ?? '-' }}</dd>
                                </div>
                                <div>
                                    <dt class="text-xs text-gray-500">No. HP</dt>
                                    <dd class="text-sm text-gray-900">{{ $biodata->no_hp_ibu ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
