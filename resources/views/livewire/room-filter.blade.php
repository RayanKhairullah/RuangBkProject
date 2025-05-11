<div>
    <div class="mb-4 flex gap-4">
        <div>
            <label for="jurusan">Jurusan:</label>
            <select wire:model="jurusan" id="jurusan" class="form-select">
                <option value="">-- Semua Jurusan --</option>
                @foreach($jurusans as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="tingkatan">Tingkatan:</label>
            <select wire:model="tingkatan" id="tingkatan" class="form-select">
                <option value="">-- Semua Tingkatan --</option>
                <option value="X">X</option>
                <option value="XI">XI</option>
                <option value="XII">XII</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">ID</th>
                    <th class="border border-gray-300 px-4 py-1">Kode Kelas</th>
                    <th class="border border-gray-300 px-4 py-1">Jurusan</th>
                    <th class="border border-gray-300 px-4 py-1">Tingkatan Kelas</th>
                    <th class="border border-gray-300 px-4 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->kode_rooms }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->jurusan->nama_jurusan }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->tingkatan_rooms }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="border border-gray-300 px-4 py-2 text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $rooms->links() }}
</div>
</div>
