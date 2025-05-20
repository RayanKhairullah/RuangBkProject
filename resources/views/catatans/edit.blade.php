<x-layouts.app :title="__('Edit Catatan Siswa')">
    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-xl shadow-md">
        <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100">{{ __('Buat/Edit Catatan') }}</h1>

        <form ... class="space-y-5">
            <div>
                <label ... class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">...</label>
                <select
                    class="block w-full rounded-md border border-gray-300 dark:border-gray-600 shadow-sm focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-500 focus:ring-opacity-50 dark:bg-gray-700 dark:text-white">
                    ...
                </select>
            </div>

            <!-- Ulangi pola di atas untuk setiap input, textarea, select -->
            
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg shadow">
                {{ __('Simpan/Update') }}
            </button>
        </form>
    </div>
</x-layouts.app>
