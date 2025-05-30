<x-layouts.app :title="__('Edit Room')">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">{{ __('Edit Room') }}</h1>

        <form action="{{ route('rooms.update', $room) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Pilih Jurusan -->
            <div>
                <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Jurusan') }}
                </label>
                <select name="jurusan_id" id="jurusan_id" required
                        class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}"
                            {{ old('jurusan_id', $room->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
                @error('jurusan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tingkatan Room -->
            <div>
                <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tingkatan Kelas') }}
                </label>
                <input type="text" name="tingkatan_rooms" id="tingkatan_rooms"
                       value="{{ old('tingkatan_rooms', $room->tingkatan_rooms) }}"
                       class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                       required>
                @error('tingkatan_rooms')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="angkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Angkatan') }}
                </label>
                <input type="text" name="angkatan_rooms" id="angkatan_rooms"
                    value="{{ old('angkatan_rooms', $room->angkatan_rooms) }}"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    required>
            </div>

            <div>
                <label for="tahun_ajaran_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tahun Ajaran Mulai') }}
                </label>
                <input type="date" name="tahun_ajaran_mulai" id="tahun_ajaran_mulai"
                    value="{{ old('tahun_ajaran_mulai', $room->tahun_ajaran_mulai) }}"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <div>
                <label for="tahun_ajaran_berakhir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tahun Ajaran Berakhir') }}
                </label>
                <input type="date" name="tahun_ajaran_berakhir" id="tahun_ajaran_berakhir"
                    value="{{ old('tahun_ajaran_berakhir', $room->tahun_ajaran_berakhir) }}"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-between">
                <button type="submit" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded shadow transition">
                    {{ __('Update') }}
                </button>
                <a href="{{ route('rooms.index') }}"
                   class="bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white px-4 py-2 rounded shadow transition">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
