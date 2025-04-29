<x-layouts.app :title="__('Rooms')">
    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('ID') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Kode Kelas') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Jurusan') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Tingkatan Kelas') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->kode_rooms }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->jurusan->nama_jurusan }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $room->tingkatan_rooms }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('rooms.edit', $room) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-sm btn-primary">
                                {{ __('View') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>