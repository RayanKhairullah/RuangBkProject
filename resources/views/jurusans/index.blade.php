<x-layouts.app :title="__('Jurusan')">
    <div class="mb-6">
        <a href="{{ route('jurusans.create') }}"
            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition dark:bg-blue-800 dark:hover:bg-blue-900">
            {{ __(' Create Jurusan') }}
        </a>
    </div>

    {{-- Form Peringatan untuk Halaman Index --}}
    <div class="bg-yellow-100 dark:bg-yellow-800 border-l-4 border-yellow-500 dark:border-yellow-400 text-yellow-700 dark:text-yellow-200 p-4 mb-6" role="alert">
        <div class="flex">
            <div class="py-1">
                <svg class="fill-current h-6 w-6 text-yellow-500 dark:text-yellow-400 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
            </div>
            <div>
                <p class="font-bold">{{ __('Perhatian Penting!') }}</p>
                <p class="text-sm">{{ __('Membuat dan menghapus jurusan adalah tindakan krusial. Pastikan Anda memahami dampaknya karena ini memiliki keterkaitan erat dengan data kelas dan data terkait lainnya. Kesalahan dapat menyebabkan inkonsistensi data dan kehilangan seluruh data kelas.') }}</p>
            </div>
        </div>
    </div>
    {{-- Akhir Form Peringatan --}}

    <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
        <table class="w-full table-auto border-collapse text-left">
            <thead>
                <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-100">
                    <th class="border-b border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('ID') }}</th>
                    <th class="border-b border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('Nama Jurusan') }}</th>
                    <th class="border-b border-gray-300 dark:border-gray-600 px-4 py-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($jurusans as $jurusan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <td class="px-4 py-2">{{ $jurusan->id }}</td>
                        <td class="px-4 py-2">{{ $jurusan->nama_jurusan }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('jurusans.show', $jurusan) }}"
                                class="inline-block px-3 py-1 text-sm text-white bg-blue-600 rounded hover:bg-blue-700 transition">
                                {{ __('Lihat Kelas') }}
                            </a>
                            {{-- <a href="{{ route('jurusans.edit', $jurusan) }}"
                                class="inline-block px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                {{ __('Edit') }}
                            </a> --}}
                            <form action="{{ route('jurusans.destroy', $jurusan) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('{{ __('Anda yakin ingin menghapus jurusan ini? Tindakan ini akan menghapus semua data kelas yang terkait dengan jurusan ini dan tidak dapat dikembalikan. Lanjutkan?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                    {{ __('Delete Jurusan') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $jurusans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>