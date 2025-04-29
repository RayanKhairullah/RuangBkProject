<!-- filepath: d:\xampp\htdocs\RuangBk\resources\views\catatans\show.blade.php -->
<x-layouts.app :title="__('Detail Catatan Prilaku')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Detail Catatan Prilaku') }}</h1>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Nama Siswa') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->user->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Jurusan') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->room->jurusan->nama_jurusan }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Tingkatan Kelas') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->room->tingkatan_rooms }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Kasus') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->kasus }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Tanggal') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->tanggal }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Nama Guru') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru->name }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Catatan Guru') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->catatan_guru }}</td>
        </tr>
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Poin') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->poin }}</td>
        </tr>
    </table>
</x-layouts.app>