<x-layouts.app :title="__('Create Biodata')">
    <form action="{{ route('biodatas.store') }}" method="POST" class="max-w-3xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf

        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">{{ __('Create Biodata') }}</h1>

        <div class="mb-4">
            <label for="nisn" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('NISN') }}</label>
            <input type="number" name="nisn" id="nisn" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jenis Kelamin') }}</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="Laki-laki">{{ __('Laki-laki') }}</option>
                <option value="Perempuan">{{ __('Perempuan') }}</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan') }}</label>
            <select name="jurusan_id" id="jurusan_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="rooms_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Rooms') }}</label>
            <select name="rooms_id" id="rooms_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->tingkatan_rooms }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Telepon') }}</label>
            <input type="number" name="telepon" id="telepon" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="agama" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Agama') }}</label>
            <select name="agama" id="agama" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="Islam">{{ __('Islam') }}</option>
                <option value="Kristen">{{ __('Kristen') }}</option>
                <option value="Hindu">{{ __('Hindu') }}</option>
                <option value="Budha">{{ __('Budha') }}</option>
                <option value="Lainnya">{{ __('Lainnya') }}</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Alamat') }}</label>
            <textarea name="alamat" id="alamat" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required></textarea>
        </div>

        <div class="mb-4">
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal Lahir') }}</label>
            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="gol_darah" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Golongan Darah') }}</label>
            <select name="gol_darah" id="gol_darah" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="A">{{ __('A') }}</option>
                <option value="B">{{ __('B') }}</option>
                <option value="AB">{{ __('AB') }}</option>
                <option value="O">{{ __('O') }}</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
            <input type="text" name="status" id="status" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">{{ __('Create') }}</button>
    </form>
</x-layouts.app>