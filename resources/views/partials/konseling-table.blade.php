<div class="space-y-6">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ __('Riwayat Konseling') }}</h1>
    
    <div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead class="bg-black-100">
            <tr>
                <th class="px-4 py-2 border dark:border-gray-600">{{ __('Lokasi') }}</th>
                <th class="px-4 py-2 border dark:border-gray-600">{{ __('Tanggal') }}</th>
                <th class="px-4 py-2 border dark:border-gray-600">{{ __('Account Guru') }}</th>
                <th class="px-4 py-2 border dark:border-gray-600">{{ __('Topik Dibahas') }}</th>
                <th class="px-4 py-2 border dark:border-gray-600">{{ __('Status Pengajuan') }}</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($konselings as $konseling)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="border px-4 py-2 dark:border-gray-600">{{ $konseling->lokasi }}</td>
                <td class="border px-4 py-2 dark:border-gray-600">{{ $konseling->tanggal }}</td>
                <td class="border px-4 py-2 dark:border-gray-600">{{ $konseling->nama_penerima }}</td>
                <td class="border px-4 py-2 dark:border-gray-600">{{ $konseling->topik_dibahas }}</td>
                <td class="border px-4 py-2 dark:border-gray-600">{{ $konseling->status }}</td>
            </tr>
            @empty
                <tr>
                <td colspan="5" class="border px-4 py-2 text-center">Tidak ada riwayat konseling.</td>
                </tr>
            @endforelse
        </tbody>
        </table>
        <div class="mt-4">
            {{ $konselings->links('pagination::tailwind') }}
        </div>
    </div>
</div>
