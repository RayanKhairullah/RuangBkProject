<x-layouts.app :title="__('Edit Room')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Edit Room') }}</h1>

    <form action="{{ route('rooms.update', $room) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <!-- Pilih Jurusan -->
        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700">{{ __('Jurusan') }}</label>
            <select name="jurusan_id" id="jurusan_id" class="form-input w-full" required>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}"
                        {{ old('jurusan_id', $room->jurusan_id) == $jurusan->id ? 'selected' : '' }}>
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
            <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700">{{ __('Tingkatan Kelas') }}</label>
            <input
                type="text"
                name="tingkatan_rooms"
                id="tingkatan_rooms"
                class="form-input w-full"
                value="{{ old('tingkatan_rooms', $room->tingkatan_rooms) }}"
                required
            >
            @error('tingkatan_rooms')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</x-layouts.app>