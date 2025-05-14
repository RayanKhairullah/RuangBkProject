<x-layouts.app :title="__('Edit Room')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Edit Room') }}</h1>

    <form action="{{ route('rooms.update', $room) }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Pilih Jurusan -->
        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan') }}</label>
            <select name="jurusan_id" id="jurusan_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}" {{ old('jurusan_id', $room->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                        {{ $jurusan->nama_jurusan }}
                    </option>
                @endforeach
            </select>
            @error('jurusan_id')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Tingkatan Room -->
        <div class="mb-4">
            <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tingkatan Kelas') }}</label>
            <input
                type="text"
                name="tingkatan_rooms"
                id="tingkatan_rooms"
                class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500"
                value="{{ old('tingkatan_rooms', $room->tingkatan_rooms) }}"
                required
            >
            @error('tingkatan_rooms')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('rooms.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-md shadow-md dark:bg-gray-600 dark:hover:bg-gray-700">
                {{ __('Cancel') }}
            </a>
            <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
                {{ __('Update') }}
            </button>
        </div>
    </form>
</x-layouts.app>