<x-layouts.app :title="__('Rooms')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-10 px-2">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300">{{ __('Daftar Room Kelas') }}</h1>
                <a href="{{ route('rooms.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-semibold shadow transition text-center">
                    {{ __('Tambah Room') }}
                </a>
            </div>

            {{-- Filter Form --}}
            <form method="GET" action="{{ route('rooms.index') }}" class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-wrap gap-4 items-end border border-indigo-100 dark:border-indigo-800">
                {{-- Jurusan --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Jurusan</label>
                    <select name="jurusan" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                        <option value="">{{ __('Semua Jurusan') }}</option>
                        @foreach($jurusans as $j)
                            <option value="{{ $j->id }}" @selected(request('jurusan') == $j->id)>
                                {{ $j->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Kode Rooms --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Kode Kelas</label>
                    <input type="text" name="kode_rooms"
                        value="{{ request('kode_rooms') }}"
                        placeholder="Cari Kode…"
                        class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
                </div>

                {{-- Tingkatan --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Tingkatan</label>
                    <input type="text" name="tingkatan"
                        value="{{ request('tingkatan') }}"
                        placeholder="Cari Tingkatan…"
                        class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
                </div>

                {{-- Buttons --}}
                <div class="flex gap-2 mt-2 md:mt-0">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('rooms.index') }}"
                        class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Reset') }}
                    </a>
                </div>
            </form>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                            <th class="border-b px-4 py-3 text-left">ID</th>
                            <th class="border-b px-4 py-3 text-left">Kode Kelas</th>
                            <th class="border-b px-4 py-3 text-left">Nama Jurusan</th>
                            <th class="border-b px-4 py-3 text-left">Tingkatan Kelas</th>
                            <th class="border-b px-4 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                <td class="border-b px-4 py-2">{{ $room->id }}</td>
                                <td class="border-b px-4 py-2">{{ $room->kode_rooms }}</td>
                                <td class="border-b px-4 py-2">{{ $room->jurusan->nama_jurusan }}</td>
                                <td class="border-b px-4 py-2">{{ $room->tingkatan_rooms }}</td>
                                <td class="border-b px-4 py-2 space-x-1">
                                    <a href="{{ route('rooms.edit', $room) }}"
                                        class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                            Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('rooms.show', $room) }}"
                                        class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                        Lihat Anggota Kelas
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 dark:text-gray-300 py-8">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $rooms->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>