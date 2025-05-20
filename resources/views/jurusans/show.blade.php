<x-layouts.app :title="__('Jurusan Details')">
    <div class="mb-6">
        <a href="{{ route('jurusans.index') }}"
            class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 dark:bg-blue-800 dark:hover:bg-blue-900 transition">
            {{ __('← Back to Jurusan') }}
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            {{ __('Nama Jurusan: ') . $jurusan->nama_jurusan }}
        </h1>

        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-3">
            {{ __('Daftar Rooms') }}
        </h2>

        <div class="overflow-x-auto">
            <table class="w-full table-auto text-sm border border-gray-300 dark:border-gray-700 rounded-md">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-200">
                        <th class="border px-4 py-2">{{ __('Kode Room') }}</th>
                        <th class="border px-4 py-2">{{ __('Tingkatan') }}</th>
                        <th class="border px-4 py-2 text-center">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800">
                    @forelse ($rooms as $room)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="border px-4 py-2 text-gray-800 dark:text-gray-100">{{ $room->kode_rooms }}</td>
                            <td class="border px-4 py-2 text-gray-800 dark:text-gray-100">{{ $room->tingkatan_rooms }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('rooms.show', $room) }}"
                                    class="inline-block px-3 py-1 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                    {{ __('View Room') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500 dark:text-gray-400">
                                {{ __('No Rooms Found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>
