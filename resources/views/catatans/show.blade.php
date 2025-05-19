<x-layouts.app :title="__('Detail Catatan Prilaku')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Detail Catatan Prilaku') }}</h1>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <!-- Nama Siswa (manual) -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Nama Siswa') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->nama_siswa }}</td>
        </tr>
        <!-- Guru Pembimbing (manual) -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Guru Pembimbing') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru_pembimbing }}</td>
        </tr>
        <!-- Nama Akun User (jika diisi) -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Akun Siswa') }}</th>
            <td class="border border-gray-300 px-4 py-2">
                {{ $catatan->user ? $catatan->user->name . ' (' . $catatan->user->email . ')' : __('-') }}
            </td>
        </tr>
        <!-- Jurusan -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Jurusan') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->room->jurusan->nama_jurusan }}</td>
        </tr>
        <!-- Tingkatan Kelas -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Tingkatan Kelas') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->room->tingkatan_rooms }}</td>
        </tr>
        <!-- Kasus -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Kasus') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->kasus }}</td>
        </tr>
        <!-- Tanggal -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Tanggal') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ \Carbon\Carbon::parse($catatan->tanggal)->format('d-m-Y') }}</td>
        </tr>
        <!-- Catatan Guru -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Catatan Guru') }}</th>
            <td class="border border-gray-300 px-4 py-2 whitespace-pre-line">{{ $catatan->catatan_guru }}</td>
        </tr>
        <!-- Poin -->
        <tr>
            <th class="border border-gray-300 px-4 py-2">{{ __('Poin') }}</th>
            <td class="border border-gray-300 px-4 py-2">{{ $catatan->poin }}</td>
        </tr>
    </table>
</x-layouts.app>