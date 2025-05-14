<x-layouts.app :title="__('Detail Catatan Prilaku')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Detail Catatan Prilaku') }}</h1>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <tbody>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Siswa') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->user->name }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->room->jurusan->nama_jurusan }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tingkatan Kelas') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->room->tingkatan_rooms }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Kasus') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->kasus }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->tanggal }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Guru') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->guru->name }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Catatan Guru') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->catatan_guru }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Poin') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->poin }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>