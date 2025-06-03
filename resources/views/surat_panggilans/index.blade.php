<x-layouts.app :title="__('Surat Panggilan')">

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">
            {{ __('Surat Panggilan') }}
        </h1>
        <a href="{{ route('surat_panggilans.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow text-sm">
            {{ __('Buat Surat Panggilan') }}
        </a>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('surat_panggilans.index') }}" class="mb-6 p-4 bg-white dark:bg-gray-800 shadow rounded-lg space-y-4 md:space-y-0 md:flex md:flex-wrap md:gap-4">
        {{-- Nama Siswa --}}
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Siswa</label>
            <input type="text" name="nama_siswa" value="{{ request('nama_siswa') }}" placeholder="Contoh: Budi Santoso"
                class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>

        {{-- Room / Jurusan --}}
        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kelas / Jurusan</label>
            <select name="room" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white">
                <option value="">{{ __('Semua Kelas/Jurusan') }}</option>
                @foreach($rooms as $r) {{-- Pastikan $rooms dikirim dari controller --}}
                <option value="{{ $r->id }}" @selected(request('room') == $r->id)>{{ $r->kode_rooms }} - {{ $r->jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        {{-- Nomor Surat --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Surat</label>
            <input type="text" name="nomor_surat" value="{{ request('nomor_surat') }}" placeholder="Contoh: SP/001/VI/2024"
                class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>

        {{-- Tanggal --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>

        {{-- Buttons --}}
        <div class="flex items-end gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('surat_panggilans.index') }}" class="border px-4 py-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                {{ __('Reset') }}
            </a>
        </div>
    </form>
    {{-- End Filter Form --}}

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow border border-gray-200 dark:border-gray-700">
        <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
            <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase font-semibold">
                <tr>
                    <th class="px-4 py-3 border dark:border-gray-600">ID</th>
                    <th class="px-4 py-3 border dark:border-gray-600">{{ __('Nama Siswa') }}</th>
                    <th class="px-4 py-3 border dark:border-gray-600">{{ __('Jurusan') }}</th>
                    <th class="px-4 py-3 border dark:border-gray-600">{{ __('Nomor Surat') }}</th>
                    <th class="px-4 py-3 border dark:border-gray-600">{{ __('Tanggal & Waktu') }}</th>
                    <th class="px-4 py-3 border dark:border-gray-600">{{ __('Tempat') }}</th>
                    <th class="px-4 py-3 text-center border dark:border-gray-600">{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratPanggilans as $sp)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $sp->id }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $sp->nama_siswa }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600 whitespace-nowrap">
                            @if($sp->room)
                                {{ $sp->room->kode_rooms }} - {{ $sp->room->jurusan->nama_jurusan }} - {{ $sp->room->tingkatan_rooms }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $sp->nomor_surat }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $sp->tanggal_waktu->format('d-m-Y H:i') }}</td>
                        <td class="px-4 py-2 border dark:border-gray-600">{{ $sp->tempat }}</td>
                        <td class="px-4 py-2 text-center space-x-1 whitespace-nowrap border dark:border-gray-600">
                            <a href="{{ route('surat_panggilans.preview_page', $sp->id) }}"
                                class="bg-green-500 hover:bg-green-600 text-white text-xs px-2 py-1 rounded">
                                <i class="fas fa-file-pdf mr-1"></i> {{ __('Lihat/Cetak PDF') }}
                            </a>
                            <a href="{{ route('surat_panggilans.edit', $sp) }}"
                               class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs px-2 py-1 rounded">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('surat_panggilans.destroy', $sp) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white text-xs px-2 py-1 rounded">
                                    {{ __('Hapus') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-6 text-gray-500 dark:text-gray-400">
                            {{ __('Tidak ada data') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $suratPanggilans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>