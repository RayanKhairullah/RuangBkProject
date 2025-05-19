<x-layouts.app :title="__('Buat Surat Panggilan')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-lg w-full p-8">
            <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Buat Surat Panggilan') }}</h1>
            <form action="{{ route('surat_panggilans.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Nama Siswa --}}
                <div>
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nama Siswa') }}</label>
                    <input type="text" name="nama_siswa" id="nama_siswa"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('nama_siswa') }}" required>
                    @error('nama_siswa')<span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Pilih Room --}}
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Pilih Kelas / Jurusan') }}</label>
                    <select name="room_id" id="room_id"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        required>
                        <option value="">{{ __('-- Pilih --') }}</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}"
                                {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')<span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span>@enderror
                </div>

                {{-- Nomor Surat --}}
                <div>
                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nomor Surat') }}</label>
                    <input type="text" name="nomor_surat" id="nomor_surat"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('nomor_surat') }}" required>
                    @error('nomor_surat') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tanggal & Waktu --}}
                <div>
                    <label for="tanggal_waktu" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tanggal & Waktu') }}</label>
                    <input type="datetime-local" name="tanggal_waktu" id="tanggal_waktu"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('tanggal_waktu') }}" required>
                    @error('tanggal_waktu') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tempat --}}
                <div>
                    <label for="tempat" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tempat') }}</label>
                    <input type="text" name="tempat" id="tempat"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('tempat') }}" required>
                    @error('tempat') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                {{-- Tujuan --}}
                <div>
                    <label for="tujuan" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tujuan') }}</label>
                    <textarea name="tujuan" id="tujuan"
                        class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        rows="3" required>{{ old('tujuan') }}</textarea>
                    @error('tujuan') <span class="text-red-500 dark:text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Create') }}
                    </button>
                    <a href="{{ route('surat_panggilans.index') }}"
                        class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>