<x-layouts.app :title="__('Detail Jadwal Konseling')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Detail Jadwal Konseling') }}</h1>

    <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <tbody>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pengirim') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->pengirim->name }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Penerima') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->penerima->name }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Lokasi') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->lokasi }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->tanggal }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Topik Dibahas') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->topik_dibahas }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Solusi') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->solusi ?? '-' }}</td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $penjadwalan->status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>