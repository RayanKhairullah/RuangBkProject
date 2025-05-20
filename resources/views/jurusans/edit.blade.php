<x-layouts.app :title="__('Edit Jurusan')">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-md p-6">
        <form action="{{ route('jurusans.update', $jurusan) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="nama_jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                    {{ __('Nama Jurusan') }}
                </label>
                <input
                    type="text"
                    name="nama_jurusan"
                    id="nama_jurusan"
                    value="{{ old('nama_jurusan', $jurusan->nama_jurusan) }}"
                    required
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition dark:bg-blue-800 dark:hover:bg-blue-900">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>