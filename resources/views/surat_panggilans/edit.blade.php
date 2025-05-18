<x-layouts.app :title="__('Edit Surat Panggilan')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Edit Surat Panggilan') }}</h1>

    <form action="{{ route('surat_panggilans.update', $suratPanggilan) }}" method="POST" class="max-w-lg space-y-4">
        @csrf
        @method('PUT')

        {{-- Nama Siswa --}}
        <div>
            <label for="nama_siswa" class="block text-sm font-medium text-gray-700">{{ __('Nama Siswa') }}</label>
            <input
                type="text"
                name="nama_siswa"
                id="nama_siswa"
                class="form-input w-full"
                value="{{ old('nama_siswa', $suratPanggilan->nama_siswa) }}"
                required
            >
            @error('nama_siswa') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Pilih Room --}}
        <div>
            <label for="room_id" class="block text-sm font-medium text-gray-700">{{ __('Kelas / Jurusan') }}</label>
            <select
                name="room_id"
                id="room_id"
                class="form-input w-full"
                required
            >
                <option value="">{{ __('-- Pilih --') }}</option>
                @foreach($rooms as $room)
                    <option
                        value="{{ $room->id }}"
                        {{ old('room_id', $suratPanggilan->room_id) == $room->id ? 'selected' : '' }}
                    >
                        {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                    </option>
                @endforeach
            </select>
            @error('room_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Nomor Surat --}}
        <div>
            <label for="nomor_surat" class="block text-sm font-medium text-gray-700">{{ __('Nomor Surat') }}</label>
            <input
                type="text"
                name="nomor_surat"
                id="nomor_surat"
                class="form-input w-full"
                value="{{ old('nomor_surat', $suratPanggilan->nomor_surat) }}"
                required
            >
            @error('nomor_surat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tanggal & Waktu --}}
        <div>
            <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700">{{ __('Tanggal & Waktu') }}</label>
            <input
                type="datetime-local"
                name="tanggal_waktu"
                id="tanggal_waktu"
                class="form-input w-full"
                value="{{ old('tanggal_waktu', $suratPanggilan->tanggal_waktu->format('Y-m-d\TH:i')) }}"
                required
            >
            @error('tanggal_waktu') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tempat --}}
        <div>
            <label for="tempat" class="block text-sm font-medium text-gray-700">{{ __('Tempat') }}</label>
            <input
                type="text"
                name="tempat"
                id="tempat"
                class="form-input w-full"
                value="{{ old('tempat', $suratPanggilan->tempat) }}"
                required
            >
            @error('tempat') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        {{-- Tujuan --}}
        <div>
            <label for="tujuan" class="block text-sm font-medium text-gray-700">{{ __('Tujuan') }}</label>
            <textarea
                name="tujuan"
                id="tujuan"
                class="form-input w-full"
                rows="4"
                required
            >{{ old('tujuan', $suratPanggilan->tujuan) }}</textarea>
            @error('tujuan') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            <a href="{{ route('surat_panggilans.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
        </div>
    </form>
</x-layouts.app>