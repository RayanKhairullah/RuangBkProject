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

            {{-- Form Peringatan --}}
            <div class="bg-yellow-100 dark:bg-yellow-800 border-l-4 border-yellow-500 dark:border-yellow-400 text-yellow-700 dark:text-yellow-200 p-4 mb-6" role="alert">
                <div class="flex">
                    <div class="py-1">
                        <svg class="fill-current h-6 w-6 text-yellow-500 dark:text-yellow-400 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg>
                    </div>
                    <div>
                        <p class="font-bold">{{ __('Perhatian Penting!') }}</p>
                        <p class="text-sm">{{ __('Membuat dan menghapus jurusan adalah tindakan krusial. Pastikan Anda memahami dampaknya karena ini memiliki keterkaitan erat dengan data Kelas dan data terkait lainnya. Kesalahan dapat menyebabkan inkonsistensi data atau kehilangan seluruh data kelas.') }}</p>
                    </div>
                </div>
            </div>
            {{-- Akhir Form Peringatan --}}

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                    {{ __('Simpan') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>