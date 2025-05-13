<x-layouts.app :title="__('Jurusan Details')">
    <div class="mb-4">
        <a href="{{ route('jurusans.index') }}" class="btn btn-secondary">{{ __('Back to Jurusan') }}</a>
    </div>

    <h1 class="text-2xl font-bold">{{ __('Nama Jurusan: ') . $jurusan->nama_jurusan }}</h1>

    <h2 class="text-xl font-bold mt-4">{{ __('Daftar Rooms') }}</h2>
    <table class="table-auto w-full mt-2 border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">{{ __('Kode Room') }}</th>
                <th class="border px-4 py-2">{{ __('Tingkatan') }}</th>
                <th class="border px-4 py-2">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($rooms as $room)
                <tr>
                    <td class="border px-4 py-2">{{ $room->kode_rooms }}</td>
                    <td class="border px-4 py-2">{{ $room->tingkatan_rooms }}</td>
                    <td class="border px-4 py-2">
                        <a href="{{ route('rooms.show', $room) }}" class="btn btn-sm btn-primary">{{ __('View Room') }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center py-2">{{ __('No Rooms Found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-layouts.app>