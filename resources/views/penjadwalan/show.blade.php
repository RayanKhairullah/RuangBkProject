<x-layouts.app :title="__('Detail Jadwal Konseling')">
    <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center">{{ __('Detail Jadwal Konseling') }}</h1>

    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-medium">
                        {{ __('Pengirim') }}
                    </th>
                    <th class="border border-gray-300 dark:border-gray-600 px-6 py-3 text-left text-sm font-medium">
                        {{ __('Detail') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->pengirim->name }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->penerima->name }}
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ __('Lokasi') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->lokasi }}
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ __('Tanggal') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->tanggal }}
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ __('Topik Dibahas') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->topik_dibahas }}
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ __('Solusi') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->solusi ?? '-' }}
                    </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ __('Status') }}
                    </td>
                    <td class="border border-gray-300 dark:border-gray-600 px-6 py-4 text-gray-900 dark:text-gray-200">
                        {{ $penjadwalan->status }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>
