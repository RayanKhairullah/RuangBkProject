<x-layouts.app :title="__('Buat Catatan Siswa')">
    <div class="max-w-2xl mx-auto my-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-8 border border-indigo-100 dark:border-indigo-800">
            <h1 class="text-3xl font-bold text-orange-500 dark:text-orange-300 mb-2 text-center">{{ __('Buat Catatan Siswa') }}</h1>
            <p class="text-gray-500 dark:text-gray-300 mb-6 text-center">Silakan isi form catatan siswa dengan lengkap dan benar.</p>

            <form action="{{ route('catatans.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Pilih Siswa -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Pilih Siswa') }}</label>
                    <select name="user_id" id="user_id"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        required>
                        <option value="" disabled selected>{{ __('-- Pilih Siswa --') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if(old('user_id') == $user->id) selected @endif>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Siswa -->
                <div>
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nama Siswa') }}</label>
                    <input type="text" name="nama_siswa" id="nama_siswa"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        placeholder="{{ __('Masukkan Nama Siswa') }}" value="{{ old('nama_siswa') }}" required>
                </div>

                <!-- Guru Pembimbing -->
                <div>
                    <label for="guru_pembimbing" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Guru Pembimbing') }}</label>
                    <input type="text" name="guru_pembimbing" id="guru_pembimbing"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        placeholder="{{ __('Masukkan Nama Guru Pembimbing') }}" value="{{ old('guru_pembimbing') }}" required>
                </div>

                <!-- Pilih Room -->
                <div>
                    <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Jurusan Siswa') }}</label>
                    <select name="room_id" id="room_id"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        required>
                        <option value="" disabled selected>{{ __('-- Pilih Kelas --') }}</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @if(old('room_id') == $room->id) selected @endif>
                                {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kasus -->
                <div>
                    <label for="kasus" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Kasus/Masalah') }}</label>
                    <input type="text" name="kasus" id="kasus"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        placeholder="{{ __('Jelaskan Kasus/Masalah') }}" value="{{ old('kasus') }}" required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tanggal') }}</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
                </div>

                <!-- Catatan Guru -->
                <div>
                    <label for="catatan_guru" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Catatan Guru') }}</label>
                    <textarea name="catatan_guru" id="catatan_guru"
                        class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        rows="4" placeholder="{{ __('Tulis catatan guru...') }}" required>{{ old('catatan_guru') }}</textarea>
                </div>

                <!-- Poin -->
                <div>
                    <label for="poin" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Poin') }}</label>
                    <input type="number" name="poin" id="poin"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        min="1" max="100" oninput="if(this.value.length>3) this.value=this.value.slice(0,3);"
                        placeholder="{{ __('Masukkan Poin (1-100)') }}" value="{{ old('poin', 0) }}" required>
                    @error('poin')
                        <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-2 flex justify-end">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Simpan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>