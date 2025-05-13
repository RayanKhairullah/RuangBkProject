<div>
    <div class="flex flex-wrap gap-4 mb-4">
        <div>
            <input
                wire:model.debounce.300ms="searchTingkatan"
                type="text"
                placeholder="Filter Tingkatan Kelas..."
                class="border rounded px-2 py-1"
            />
        </div>
        <div>
            <input
                wire:model.debounce.300ms="searchJurusan"
                type="text"
                placeholder="Filter Jurusan..."
                class="border rounded px-2 py-1"
            />
        </div>
        <div>
            <select wire:model="perPage" class="border rounded px-2 py-1">
                <option value="5">5 per halaman</option>
                <option value="10">10 per halaman</option>
                <option value="25">25 per halaman</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Kode Kelas</th>
                    <th class="border px-2 py-1">Jurusan</th>
                    <th class="border px-2 py-1">Tingkatan</th>
                    <th class="border px-2 py-1">Aksi</th>
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
                            <a href="{{ route('rooms.show', $room) }}" class="btn btn-sm btn-primary">View</a>
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

    <div class="mt-4">
        {{ $rooms->links() }}
    </div>
</div>