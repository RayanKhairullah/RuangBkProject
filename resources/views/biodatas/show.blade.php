<x-layouts.app :title="__('Biodata')">
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow font-semibold inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd" />
            </svg>          
        </a>
        <h1 class="text-2xl font-semibold text-gray-800">Biodata Lengkap</h1>
        <a href="{{ route('biodatas.edit') }}" class="text-sm text-white border border-gray-300 px-3 py-1.5 rounded-md hover:bg-gray-100 transition">
            {{ __('Edit Biodata') }}
        </a>
        
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Kolom Foto -->
        <div class="flex justify-center md:justify-start">
            @if($biodata->image)
                <div class="w-40 h-52 bg-gray-200 rounded shadow flex items-center justify-center">
                    <img src="{{ asset('storage/' . $biodata->image) }}" alt="Foto Siswa"
                         class="object-contain max-w-full max-h-full rounded">
                </div>
            @else
                <div class="w-40 h-52 bg-blue-600 text-white rounded shadow flex items-center justify-center text-sm">
                    Foto Siswa
                </div>
            @endif
        </div>

        <!-- Kolom Tabel -->
        <div class="md:col-span-2">
            <table class="table-auto w-full text-sm md:text-base border-gray-300">
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <th class="text-left p-2 font-medium w-40">{{ __('NISN:') }}</th>
                        <td class="p-2">{{ $biodata->nisn }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Jenis Kelamin:') }}</th>
                        <td class="p-2">{{ $biodata->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Jurusan:') }}</th>
                        <td class="p-2">{{ $biodata->jurusan->nama_jurusan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Kelas:') }}</th>
                        <td class="p-2">{{ $biodata->rooms->tingkatan_rooms }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Telepon:') }}</th>
                        <td class="p-2">{{ $biodata->telepon }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Agama:') }}</th>
                        <td class="p-2">{{ $biodata->agama }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Alamat:') }}</th>
                        <td class="p-2">{{ $biodata->alamat }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Tanggal Lahir:') }}</th>
                        <td class="p-2">{{ $biodata->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Golongan Darah:') }}</th>
                        <td class="p-2">{{ $biodata->gol_darah }}</td>
                    </tr>
                    <tr>
                        <th class="text-left p-2 font-medium">{{ __('Status:') }}</th>
                        <td class="p-2">{{ $biodata->status }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
