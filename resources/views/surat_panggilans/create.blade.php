<x-layouts.app :title="__('Buat Surat Panggilan')">
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-8">{{ __('Buat Surat Panggilan') }}</h1>

        <form action="{{ route('surat_panggilans.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Nama Siswa --}}
            <div>
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Nama Siswa') }}
                </label>
                <input type="text" name="nama_siswa" id="nama_siswa"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="{{ old('nama_siswa') }}" required>
                @error('nama_siswa')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Room --}}
            <div>
                <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Pilih Kelas / Jurusan') }}
                </label>
                <select name="room_id" id="room_id"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    required>
                    <option value="">{{ __('-- Pilih --') }}</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                            {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                        </option>
                    @endforeach
                </select>
                @error('room_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nomor Surat --}}
            <div>
                <label for="nomor_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Nomor Surat') }}
                </label>
                <input type="text" name="nomor_surat" id="nomor_surat"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="{{ old('nomor_surat') }}" required placeholder="Contoh: XI/123/SP/2025">
                @error('nomor_surat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal & Waktu --}}
            <div>
                <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Tanggal & Waktu') }}
                </label>
                <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="{{ old('tanggal_waktu') }}" required>
                @error('tanggal_waktu')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tempat --}}
            <div>
                <label for="tempat" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Tempat') }}
                </label>
                <input type="text" name="tempat" id="tempat"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    value="{{ old('tempat') }}" required placeholder="Contoh: Ruang BK">
                @error('tempat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tujuan --}}
            <div>
                <label for="tujuan" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">
                    {{ __('Tujuan') }}
                </label>
                <textarea name="tujuan" id="tujuan"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    rows="4" required placeholder="Contoh:
1. Menyampaikan informasi pelanggaran
2. Memanggil orang tua/wali siswa
3. Pembinaan karakter siswa">{{ old('tujuan') }}</textarea>
                @error('tujuan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">
                    {{ __('Create') }}
                </button>
                <a href="{{ route('surat_panggilans.index') }}"
                    class="px-5 py-2 border border-gray-300 dark:border-gray-500 rounded-lg text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-layouts.app>
