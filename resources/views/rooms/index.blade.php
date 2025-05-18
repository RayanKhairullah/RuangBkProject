<x-layouts.app :title="__('Rooms')">
    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
    </div>

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