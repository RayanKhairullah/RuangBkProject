<x-layouts.app :title="__('Create Room')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Create Room') }}</h1>

    <form action="{{ route('rooms.store') }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf

        <!-- Jurusan -->
        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan') }}</label>
            <select name="jurusan_id" id="jurusan_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">{{ __('Pilih Jurusan') }}</option>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tingkatan Room -->
        <div class="mb-4">
            <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tingkatan Room') }}</label>
            <input type="text" name="tingkatan_rooms" id="tingkatan_rooms" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Create') }}
        </button>
    </form>
</x-layouts.app>