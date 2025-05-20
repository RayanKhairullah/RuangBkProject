<x-layouts.app :title="__('Jurusan')">
    <div class="mb-6">
        <a href="{{ route('jurusans.create') }}"
            class="inline-block px-4 py-2 text-sm font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition dark:bg-blue-800 dark:hover:bg-blue-900">
            {{ __(' Create Jurusan') }}
        </a>
    </div>

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
                                {{ __('View') }}
                            </a>
                            <a href="{{ route('jurusans.edit', $jurusan) }}"
                                class="inline-block px-3 py-1 text-sm text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                                {{ __('Edit') }}
                            </a>
                            <form action="{{ route('jurusans.destroy', $jurusan) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('{{ __('Are you sure?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-block px-3 py-1 text-sm text-white bg-red-600 rounded hover:bg-red-700 transition">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $jurusans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>