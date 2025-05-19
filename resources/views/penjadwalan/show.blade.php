<x-layouts.app :title="__('Detail Jadwal Konseling')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-lg w-full p-8">
            <h1 class="text-2xl md:text-3xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Detail Jadwal Konseling') }}</h1>
            <table class="table-auto w-full border-collapse">
                <tbody class="text-gray-700 dark:text-gray-200 text-sm md:text-base">
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4 w-1/3">{{ __('Pengirim') }}</th>
                        <td class="py-2">{{ $penjadwalan->pengirim->name }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Penerima') }}</th>
                        <td class="py-2">{{ $penjadwalan->penerima->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Lokasi') }}</th>
                        <td class="py-2">{{ $penjadwalan->lokasi }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Tanggal') }}</th>
                        <td class="py-2">{{ $penjadwalan->tanggal }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Topik Dibahas') }}</th>
                        <td class="py-2">{{ $penjadwalan->topik_dibahas }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Solusi') }}</th>
                        <td class="py-2">{{ $penjadwalan->solusi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">{{ __('Status') }}</th>
                        <td class="py-2">{{ $penjadwalan->status }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('penjadwalan.index') }}"
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-full font-semibold shadow transition text-sm">
                    &larr; {{ __('Kembali ke Daftar Jadwal') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>