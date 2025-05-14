<x-layouts.app :title="__('Catatan Prilaku')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Catatan Prilaku') }}</h1>
        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
            <div class="flex space-x-2">
                <a href="{{ route('catatans.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
                    {{ __('Buat Catatan') }}
                </a>
                <a href="{{ route('catatans.download') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md shadow-md dark:bg-green-600 dark:hover:bg-green-700">
                    {{ __('Download Semua Catatan') }}
                </a>
            </div>
        @endif
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Siswa') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan Siswa') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tingkatan Kelas') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Kasus') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Guru') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Catatan Guru') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Poin') }}</th>
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($catatans as $catatan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->user->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">
                            {{ $catatan->room->jurusan->nama_jurusan }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">
                            {{ $catatan->room->tingkatan_rooms }}
                        </td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->kasus }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->tanggal }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->guru->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->catatan_guru }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $catatan->poin }}</td>
                        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">
                                <div class="flex space-x-2">
                                    <a href="{{ route('catatans.edit', $catatan->id) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow-md">{{ __('Edit') }}</a>
                                    <form action="{{ route('catatans.destroy', $catatan->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md" onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">{{ __('Hapus') }}</button>
                                    </form>
                                    <a href="{{ route('catatans.show', $catatan->id) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">{{ __('Show') }}</a>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $catatans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>
