<x-layouts.app :title="__('Edit Jurusan')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-md w-full p-8">
            <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Edit Jurusan') }}</h1>
            <form action="{{ route('jurusans.update', $jurusan) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="nama_jurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nama Jurusan') }}</label>
                    <input type="text" name="nama_jurusan" id="nama_jurusan"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ $jurusan->nama_jurusan }}" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Update') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>