<x-layouts.app :title="__('Edit Room')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-md w-full p-8">
            <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Edit Room') }}</h1>
            <form action="{{ route('rooms.update', $room) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Pilih Jurusan -->
                <div>
                    <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Jurusan') }}</label>
                    <select name="jurusan_id" id="jurusan_id"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        required>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}"
                                {{ old('jurusan_id', $room->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tingkatan Room -->
                <div>
                    <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tingkatan Kelas') }}</label>
                    <input
                        type="text"
                        name="tingkatan_rooms"
                        id="tingkatan_rooms"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('tingkatan_rooms', $room->tingkatan_rooms) }}"
                        placeholder="Contoh: X, XI, XII"
                        required
                    >
                    @error('tingkatan_rooms')
                        <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Update') }}
                    </button>
                    <a href="{{ route('rooms.index') }}"
                        class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>