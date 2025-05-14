<x-layouts.app :title="__('Edit Catatan Prilaku')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Edit Catatan Prilaku') }}</h1>

    <form action="{{ route('catatans.update', $catatan->id) }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Pilih Siswa -->
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pilih Siswa') }}</label>
            <select name="user_id" id="user_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" @if($catatan->user_id == $user->id) selected @endif>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Pilih Room -->
        <div class="mb-4">
            <label for="room_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pilih Kelas') }}</label>
            <select name="room_id" id="room_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">{{ __('Pilih Kelas') }}</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" @if($catatan->room_id == $room->id) selected @endif>
                        {{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Kasus -->
        <div class="mb-4">
            <label for="kasus" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Kasus') }}</label>
            <input type="text" name="kasus" id="kasus" value="{{ $catatan->kasus }}" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</label>
            <input type="date" name="tanggal" id="tanggal" value="{{ $catatan->tanggal }}" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Catatan Guru -->
        <div class="mb-4">
            <label for="catatan_guru" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Catatan Guru') }}</label>
            <textarea name="catatan_guru" id="catatan_guru" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" rows="4" required>{{ $catatan->catatan_guru }}</textarea>
        </div>

        <!-- Poin -->
        <div class="mb-4">
            <label for="poin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Poin') }}</label>
            <input type="number" name="poin" id="poin" value="{{ $catatan->poin }}" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" min="10" max="100" required>
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Update') }}
        </button>
    </form>
</x-layouts.app>