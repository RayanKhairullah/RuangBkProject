<x-layouts.app :title="__('Buat Surat Panggilan')">
    <form action="{{ route('surat_panggilans.store') }}" method="POST" class="mt-4">
        @csrf

        {{-- Nama Siswa --}}
        <div class="mb-4">
            <label for="nama_siswa">{{ __('Nama Siswa') }}</label>
            <input type="text" name="nama_siswa" id="nama_siswa"
                   class="form-input w-full"
                   value="{{ old('nama_siswa') }}" required>
            @error('nama_siswa')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        {{-- Pilih Room --}}
        <div class="mb-4">
            <label for="room_id">{{ __('Pilih Kelas / Jurusan') }}</label>
            <select name="room_id" id="room_id" class="form-input w-full" required>
                <option value="">{{ __('-- Pilih --') }}</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}"
                        {{ old('room_id') == $room->id ? 'selected' : '' }}>
                        {{ $room->kode_rooms }}
                        - {{ $room->jurusan->nama_jurusan }}
                        - {{ $room->tingkatan_rooms }}
                    </option>
                @endforeach
            </select>
            @error('room_id')<span class="text-red-500">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label for="nomor_surat" class="block text-sm font-medium text-gray-700">{{ __('Nomor Surat') }}</label>
            <input type="text" name="nomor_surat" id="nomor_surat" class="form-input w-full" value="{{ old('nomor_surat') }}" required placeholder="XI">
            @error('nomor_surat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700">{{ __('Tanggal & Waktu') }}</label>
            <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu" class="form-input w-full" value="{{ old('tanggal_waktu') }}" required>
            @error('tanggal_waktu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tempat" class="block text-sm font-medium text-gray-700">{{ __('Tempat') }}</label>
            <input type="text" name="tempat" id="tempat" class="form-input w-full" value="{{ old('tempat') }}" required>
            @error('tempat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="tujuan" class="block text-sm font-medium text-gray-700">{{ __('Tujuan') }}</label>
            <textarea name="tujuan" id="tujuan" class="form-input w-full" rows="3" required 
            placeholder="contoh:
            1.abcd
            2.abcd
            3.abcd"
            >{{ old('tujuan') }}</textarea>
            @error('tujuan') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
        <a href="{{ route('surat_panggilans.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
    </form>
</x-layouts.app>