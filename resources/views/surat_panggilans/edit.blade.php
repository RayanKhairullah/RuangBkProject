<x-layouts.app :title="__('Edit Surat Panggilan')">
    <div class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-900 rounded-lg shadow">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">
            {{ __('Edit Surat Panggilan') }}
        </h1>

        <form action="{{ route('surat_panggilans.update', $suratPanggilan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama Siswa --}}
            <div>
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Nama Siswa') }}
                </label>
                <input type="text" name="nama_siswa" id="nama_siswa"
                       class="form-input w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                       value="{{ old('nama_siswa', $suratPanggilan->nama_siswa) }}" required>
                @error('nama_siswa')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Kelas / Jurusan --}}
            <div>
                <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Kelas / Jurusan') }}
                </label>
                <select name="room_id" id="room_id"
                        class="form-select w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                        required>
                    <option value="">{{ __('-- Pilih --') }}</option>
                    @foreach($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id', $suratPanggilan->room_id) == $room->id ? 'selected' : '' }}>
                            {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Nomor Surat --}}
            <div>
                <label for="nomor_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Nomor Surat') }}
                </label>
                <input type="text" name="nomor_surat" id="nomor_surat"
                       class="form-input w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                       value="{{ old('nomor_surat', $suratPanggilan->nomor_surat) }}" required>
                @error('nomor_surat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tanggal & Waktu --}}
            <div>
                <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Tanggal & Waktu') }}
                </label>
                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu"
                       class="form-input w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                       value="{{ old('tanggal_waktu', $suratPanggilan->tanggal_waktu->format('Y-m-d\TH:i')) }}" required>
                @error('tanggal_waktu')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tempat --}}
            <div>
                <label for="tempat" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Tempat') }}
                </label>
                <input type="text" name="tempat" id="tempat"
                       class="form-input w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                       value="{{ old('tempat', $suratPanggilan->tempat) }}" required>
                @error('tempat')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tujuan --}}
            <div>
                <label for="tujuan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                    {{ __('Tujuan') }}
                </label>
                <textarea name="tujuan" id="tujuan"
                          class="form-textarea w-full px-4 py-2 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-blue-200"
                          rows="4" required>{{ old('tujuan', $suratPanggilan->tujuan) }}</textarea>
                @error('tujuan')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-medium px-4 py-2 rounded shadow transition">
                    {{ __('Update') }}
                </button>
                <a href="{{ route('surat_panggilans.index') }}"
                   class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-200 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
