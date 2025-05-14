<x-layouts.app :title="__('Jurusan')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Jurusan') }}</h1>
        <a href="{{ route('jurusans.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Create Jurusan') }}
        </a>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ID') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Jurusan') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusans as $jurusan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jurusan->id }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jurusan->nama_jurusan }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300 space-x-2">
                            <a href="{{ route('jurusans.edit', $jurusan) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow-md">{{ __('Edit') }}</a>
                            <form action="{{ route('jurusans.destroy', $jurusan) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>