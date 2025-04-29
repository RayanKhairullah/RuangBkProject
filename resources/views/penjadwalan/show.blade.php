<!-- filepath: d:\xampp\htdocs\RuangBk\resources\views\penjadwalan\show.blade.php -->
<x-layouts.app :title="__('Detail Jadwal Konseling')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Detail Jadwal Konseling') }}</h1>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Pengirim') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->pengirim->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Penerima') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->penerima->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Lokasi') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->lokasi }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Tanggal') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->tanggal }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Topik Dibahas') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->topik_dibahas }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Solusi') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->solusi ?? '-' }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Status') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $penjadwalan->status }}</td>
        </tr>
    </table>
</x-layouts.app>