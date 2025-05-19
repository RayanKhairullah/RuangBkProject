<x-layouts.app :title="__('Detail Catatan Prilaku')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-10 px-2 flex items-center justify-center">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-xl w-full p-8">
            <h1 class="text-3xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Detail Catatan Prilaku') }}</h1>
            <table class="table-auto w-full border-collapse">
                <tbody class="text-gray-700 dark:text-gray-200 text-sm md:text-base">
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4 w-1/3">Nama Siswa</th>
                        <td class="py-2">{{ $catatan->user->name }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">Jurusan</th>
                        <td class="py-2">{{ $catatan->room->jurusan->nama_jurusan }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">Tingkatan Kelas</th>
                        <td class="py-2">{{ $catatan->room->tingkatan_rooms }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">Kasus</th>
                        <td class="py-2">{{ $catatan->kasus }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">Tanggal</th>
                        <td class="py-2">{{ $catatan->tanggal }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">Nama Guru</th>
                        <td class="py-2">{{ $catatan->guru->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">Catatan Guru</th>
                        <td class="py-2">{{ $catatan->catatan_guru }}</td>
                    </tr>
                    <tr class="bg-indigo-50 dark:bg-gray-700">
                        <th class="text-left font-semibold py-2 pr-4">Guru Pembimbing</th>
                        <td class="py-2">{{ $catatan->guru_pembimbing }}</td>
                    </tr>
                    <tr>
                        <th class="text-left font-semibold py-2 pr-4">Poin</th>
                        <td class="py-2">{{ $catatan->poin }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-8 flex justify-end">
                <a href="{{ route('catatans.index') }}"
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-6 py-2 rounded-full font-semibold shadow transition">
                    {{ __('Kembali') }}
                </a>
            </div>
        </div>
    </div>
</x-layouts.app>