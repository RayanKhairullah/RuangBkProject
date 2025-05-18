<x-layouts.app :title="__('Rooms')">
    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
    </div>

        {{-- Filter Form --}}
    <form method="GET" action="{{ route('rooms.index') }}" class="mb-4 flex flex-wrap gap-3 items-end">
        {{-- Jurusan --}}
        <div>
            <label class="block text-sm">Jurusan</label>
            <select name="jurusan" class="px-3 py-1 border rounded">
                <option value="">{{ __('Semua Jurusan') }}</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id }}"
                        @selected(request('jurusan') == $j->id)>
                        {{ $j->nama_jurusan }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Kode Rooms --}}
        <div>
            <label class="block text-sm">Kode Kelas</label>
            <input type="text" name="kode_rooms"
                   value="{{ request('kode_rooms') }}"
                   placeholder="Search Kode…"
                   class="px-3 py-1 border rounded" />
        </div>

        {{-- Tingkatan --}}
        <div>
            <label class="block text-sm">Tingkatan</label>
            <input type="text" name="tingkatan"
                   value="{{ request('tingkatan') }}"
                   placeholder="Search Tingkatan…"
                   class="px-3 py-1 border rounded" />
        </div>

        {{-- Buttons --}}
        <div class="flex gap-2">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-1 rounded">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('rooms.index') }}"
               class="px-4 py-1 border rounded text-gray-600">
               {{ __('Reset') }}
            </a>
        </div>
    </form>
    
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Kode Kelas</th>
                    <th class="border px-2 py-1">Nama Jurusan</th>
                    <th class="border px-2 py-1">Tingkatan Kelas</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr>
                        <td class="border px-2 py-1">{{ $room->id }}</td>
                        <td class="border px-2 py-1">{{ $room->kode_rooms }}</td>
                        <td class="border px-2 py-1">{{ $room->jurusan->nama_jurusan }}</td>
                        <td class="border px-2 py-1">{{ $room->tingkatan_rooms }}</td>
                        <td class="border px-2 py-1 space-x-1">
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Yakin?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('rooms.show', $room) }}" class="btn btn-sm btn-primary">Lihat Anggota Kelas</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-2">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Tampilkan tautan pagination -->
    <div class="mt-4">
        {{ $rooms->links('pagination::tailwind') }}
    </div>
</x-layouts.app>