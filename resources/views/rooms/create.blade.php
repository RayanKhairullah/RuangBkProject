<x-layouts.app :title="__('Create Room')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-md w-full p-8">
            <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Tambah Room Baru') }}</h1>
            <form action="{{ route('rooms.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Jurusan') }}</label>
                    <select name="jurusan_id" id="jurusan_id"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        required>
                        <option value="" disabled selected>{{ __('Pilih Jurusan') }}</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tingkatan Room') }}</label>
                    <input type="text" name="tingkatan_rooms" id="tingkatan_rooms"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        placeholder="Contoh: X, XI, XII" required>
                </div>
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>