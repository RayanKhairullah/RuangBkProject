<x-layouts.app :title="__('Jurusan Details')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex flex-col items-center py-10 px-2">
        <div class="w-full max-w-2xl">
            <div class="mb-6 flex items-center gap-2">
                <a href="{{ route('jurusans.index') }}"
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                    &larr; {{ __('Kembali ke Daftar Jurusan') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 p-8 mb-8">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-2 text-center">
                    {{ __('Nama Jurusan:') }} <span class="text-indigo-700 dark:text-indigo-300">{{ $jurusan->nama_jurusan }}</span>
                </h1>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800 p-6">
                <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300 mb-4 text-center">{{ __('Daftar Rooms') }}</h2>
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                            <th class="border-b px-4 py-3 text-left">{{ __('Kode Room') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Tingkatan') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $room)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                <td class="border-b px-4 py-2">{{ $room->kode_rooms }}</td>
                                <td class="border-b px-4 py-2">{{ $room->tingkatan_rooms }}</td>
                                <td class="border-b px-4 py-2">
                                    <a href="{{ route('rooms.show', $room) }}"
                                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('View Room') }}
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 dark:text-gray-300 py-8">{{ __('No Rooms Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layouts.app>