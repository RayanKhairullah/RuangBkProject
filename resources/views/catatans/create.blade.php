<x-layouts.app :title="__('Buat Catatan Prilaku')">
    <h1 class="text-2xl font-bold">{{ __('Buat Catatan Prilaku') }}</h1>

    <form action="{{ route('catatans.store') }}" method="POST" class="mt-4">
        @csrf

        <!-- Pilih Siswa -->
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">{{ __('Pilih Siswa') }}</label>
            <select name="user_id" id="user_id" class="form-input w-full">
                <option value="">{{ __('Pilih Siswa') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Siswa -->
        <div class="mb-4">
            <label for="nama_siswa" class="block text-sm font-medium text-gray-700">{{ __('Nama Siswa') }}</label>
            <input type="text" name="nama_siswa" id="nama_siswa" class="form-input w-full" required>
        </div>

        <!-- Guru Pembimbing -->
        <div class="mb-4">
            <label for="guru_pembimbing" class="block text-sm font-medium text-gray-700">{{ __('Guru Pembimbing') }}</label>
            <input type="text" name="guru_pembimbing" id="guru_pembimbing" class="form-input w-full" required>
        </div>

        <!-- Pilih Room -->
        <div class="mb-4">
            <label for="room_id" class="block text-sm font-medium text-gray-700">{{ __('Pilih Kelas') }}</label>
            <select name="room_id" id="room_id" class="form-input w-full" required>
                <option value="">{{ __('Pilih Kelas') }}</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->jurusan->nama_jurusan }} - {{ $room->tingkatan_rooms }}</option>
                @endforeach
            </select>
        </div>

        <!-- Kasus -->
        <div class="mb-4">
            <label for="kasus" class="block text-sm font-medium text-gray-700">{{ __('Kasus') }}</label>
            <input type="text" name="kasus" id="kasus" class="form-input w-full" required>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700">{{ __('Tanggal') }}</label>
            <input type="date" name="tanggal" id="tanggal" class="form-input w-full" required>
        </div>

        <!-- Catatan Guru -->
        <div class="mb-4">
            <label for="catatan_guru" class="block text-sm font-medium text-gray-700">{{ __('Catatan Guru') }}</label>
            <textarea name="catatan_guru" id="catatan_guru" class="form-input w-full" rows="4" required></textarea>
        </div>

        <!-- Poin -->
        <div class="mb-4">
            <label for="poin" class="block text-sm font-medium text-gray-700">{{ __('Poin') }}</label>
            <input type="number" name="poin" id="poin" class="form-input w-full" min="10" max="100" required>
        </div>

        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
    </form>
</x-layouts.app>