<x-layouts.app :title="__('Buat Catatan Siswa')">
    <div class="max-w-4xl mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Buat Catatan') }}</h1>

        <form action="{{ route('catatans.store') }}" method="POST"
              class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg grid grid-cols-1 md:grid-cols-2 gap-6">
            @csrf

            <!-- Pilih Siswa -->
            <div class="col-span-1 p-2">
                <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Pilih Siswa') }}
                </label>
                <select name="user_id" id="user_id"
                        class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500">
                    <option value="" disabled selected>{{ __('-- Pilih Siswa --') }}</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @selected(old('user_id') == $user->id)>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Siswa -->
            <div class="col-span-1 p-2">
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Nama Siswa') }}
                </label>
                <input type="text" name="nama_siswa" id="nama_siswa"
                       class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                       placeholder="{{ __('Masukkan Nama Siswa') }}" value="{{ old('nama_siswa') }}" required>
            </div>

            <!-- Guru Pembimbing -->
            <div class="col-span-1 p-2">
                <label for="guru_pembimbing" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Guru Pembimbing') }}
                </label>
                <input type="text" name="guru_pembimbing" id="guru_pembimbing"
                       class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                       placeholder="{{ __('Masukkan Nama Guru Pembimbing') }}" value="{{ old('guru_pembimbing') }}" required>
            </div>

            <!-- Pilih Room -->
            <div class="col-span-1 p-2">
                <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Jurusan Siswa') }}
                </label>
                <select name="room_id" id="room_id"
                        class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                        required>
                    <option value="" disabled selected>{{ __('-- Pilih Kelas --') }}</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                            {{ $room->kode_rooms }} - {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Kasus -->
            <div class="col-span-2 p-2">
                <label for="kasus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Kasus/Masalah') }}
                </label>
                <input type="text" name="kasus" id="kasus"
                       class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                       placeholder="{{ __('Jelaskan Kasus/Masalah') }}" value="{{ old('kasus') }}" required>
            </div>

            <!-- Tanggal -->
            <div class="col-span-1 p-2">
                <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tanggal') }}
                </label>
                <input type="date" name="tanggal" id="tanggal"
                       class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                       value="{{ old('tanggal', now()->format('Y-m-d')) }}" required>
            </div>

            <!-- Poin -->
            <div class="col-span-1 p-2">
                <label for="poin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Poin') }}
                </label>
                <input type="number" name="poin" id="poin" min="1" max="100"
                       class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                       placeholder="{{ __('Masukkan Poin (1-100)') }}" value="{{ old('poin', 0) }}" required>
                @error('poin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catatan Guru -->
            <div class="col-span-2 p-2">
                <label for="catatan_guru" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Catatan Guru') }}
                </label>
                <textarea name="catatan_guru" id="catatan_guru" rows="4"
                          class="mt-1 p-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring focus:ring-blue-500"
                          placeholder="{{ __('Tulis catatan guru...') }}" required>{{ old('catatan_guru') }}</textarea>
            </div>

            <!-- Tombol -->
            <div class="col-span-2 text-right p-2">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg shadow transition">
                    {{ __('Simpan') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>