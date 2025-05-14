<x-layouts.app :title="__('Room Details')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Room Details') }}</h1>
        <a href="{{ route('rooms.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Create Room') }}
        </a>
    </div>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ __('Kode Kelas: ') . $room->kode_rooms }}</h2>
        <p class="text-gray-700 dark:text-gray-300 mb-2">{{ __('Jurusan: ') . $room->jurusan->nama_jurusan }}</p>
        <p class="text-gray-700 dark:text-gray-300 mb-2">{{ __('Tingkatan Kelas: ') . $room->tingkatan_rooms }}</p>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">{{ __('Anggota Kelas') }}</h2>
        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <table class="table-auto w-full border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</th>
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Biodata') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $user->name }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $user->email }}</td>
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">
                                @if ($user->biodata)
                                    <a href="{{ route('users.downloadBiodata', $user) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md shadow-md">
                                        {{ __('Download') }}
                                    </a>
                                @else
                                    <span class="text-red-500">{{ __('Not Completed') }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>