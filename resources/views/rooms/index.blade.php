<x-layouts.app :title="__('Rooms')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">{{ __('Daftar Kelas') }}</h1>
        <a href="{{ route('rooms.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            {{ __('+ Tambah Kelas') }}
        </a>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('rooms.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded shadow mb-6 space-y-4 md:space-y-0 md:flex md:items-end md:gap-4">
        {{-- Jurusan --}}
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jurusan</label>
            <select name="jurusan" class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                <option value="">{{ __('Semua Jurusan') }}</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id }}" @selected(request('jurusan') == $j->id)>
                        {{ $j->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kode Rooms --}}
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kelas</label>
            <input type="text" name="kode_rooms" value="{{ request('kode_rooms') }}"
                   class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   placeholder="Cari kode…">
        </div>

        {{-- Tingkatan --}}
        <div class="flex-1">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkatan</label>
            <input type="text" name="tingkatan" value="{{ request('tingkatan') }}"
                   class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                   placeholder="Cari tingkatan…">
        </div>

        {{-- Tombol --}}
        <div class="flex gap-2 mt-4 md:mt-0">
            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('rooms.index') }}"
               class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white px-4 py-2 rounded shadow">
                {{ __('Reset') }}
            </a>
        </div>
    </form>

    {{-- Table Data --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase">
                <tr>
                    <th class="px-4 py-2 border">ID</th>
                    <th class="px-4 py-2 border">Kode Kelas</th>
                    <th class="px-4 py-2 border">Jurusan</th>
                    <th class="px-4 py-2 border">Tingkatan</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-200">
                @forelse ($rooms as $room)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 border">{{ $room->id }}</td>
                        <td class="px-4 py-2 border">{{ $room->kode_rooms }}</td>
                        <td class="px-4 py-2 border">{{ $room->jurusan->nama_jurusan }}</td>
                        <td class="px-4 py-2 border">{{ $room->tingkatan_rooms }}</td>
                        <td class="px-4 py-2 border space-x-2">
                            <a href="{{ route('rooms.show', $room) }}"
                               class="text-xs bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                Lihat
                            </a>
                            <a href="{{ route('rooms.edit', $room) }}"
                               class="text-xs bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">
                                Edit
                            </a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-xs bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $rooms->withQueryString()->links('pagination::tailwind') }}
    </div>
</x-layouts.app>