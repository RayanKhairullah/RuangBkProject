<x-layouts.app :title="__('Detail Catatan Prilaku')">
    <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-gray-100">{{ __('Detail Catatan Prilaku') }}</h1>

    <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
        <!-- Nama Siswa (manual) -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Nama Siswa') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->nama_siswa }}
            </td>
        </tr>
        <!-- Guru Pembimbing (manual) -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Guru Pembimbing') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->guru_pembimbing }}
            </td>
        </tr>
        <!-- Nama Akun User (jika diisi) -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Akun Siswa') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->user ? $catatan->user->name . ' (' . $catatan->user->email . ')' : __('-') }}
            </td>
        </tr>
        <!-- Jurusan -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Jurusan') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->room->jurusan->nama_jurusan }}
            </td>
        </tr>
        <!-- Tingkatan Kelas -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Tingkatan Kelas') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->room->tingkatan_rooms }}
            </td>
        </tr>
        <!-- Kasus -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Kasus') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->kasus }}
            </td>
        </tr>
        <!-- Tanggal -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Tanggal') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ \Carbon\Carbon::parse($catatan->tanggal)->format('d-m-Y') }}
            </td>
        </tr>
        <!-- Catatan Guru -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Catatan Guru') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 whitespace-pre-line text-gray-900 dark:text-gray-200">
                {{ $catatan->catatan_guru }}
            </td>
        </tr>
        <!-- Poin -->
        <tr>
            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-left text-gray-700 dark:text-gray-300">
                {{ __('Poin') }}
            </th>
            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-gray-900 dark:text-gray-200">
                {{ $catatan->poin }}
            </td>
        </tr>
    </table>
</x-layouts.app>
