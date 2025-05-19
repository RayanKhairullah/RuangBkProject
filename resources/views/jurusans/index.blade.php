<x-layouts.app :title="__('Jurusan')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-10 px-2">
        <div class="max-w-3xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300">{{ __('Daftar Jurusan') }}</h1>
                <a href="{{ route('jurusans.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-semibold shadow transition text-center">
                    {{ __('Tambah Jurusan') }}
                </a>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                            <th class="border-b px-4 py-3 text-left">{{ __('ID') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Nama Jurusan') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jurusans as $jurusan)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                <td class="border-b px-4 py-2">{{ $jurusan->id }}</td>
                                <td class="border-b px-4 py-2">{{ $jurusan->nama_jurusan }}</td>
                                <td class="border-b px-4 py-2 space-x-1">
                                    <a href="{{ route('jurusans.show', $jurusan) }}"
                                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('View') }}
                                    </a>
                                    <a href="{{ route('jurusans.edit', $jurusan) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('jurusans.destroy', $jurusan) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition"
                                            onclick="return confirm('{{ __('Are you sure?') }}')">
                                            {{ __('Delete') }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-gray-500 dark:text-gray-300 py-8">{{ __('Tidak ada data jurusan.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $jurusans->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>