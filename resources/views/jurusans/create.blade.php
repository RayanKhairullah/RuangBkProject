<x-layouts.app :title="__('Create Jurusan')">
    <div class="max-w-xl mx-auto mt-10 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
            {{ __('Tambah Jurusan Baru') }}
        </h1>

        <form action="{{ route('jurusans.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="nama_jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Nama Jurusan') }}
                </label>
                <input type="text" name="nama_jurusan" id="nama_jurusan"
                       class="w-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Contoh: Rekayasa Perangkat Lunak" required>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    {{ __('Simpan') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
