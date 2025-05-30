<x-layouts.app :title="__('Create Room')">
    <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">
        <form action="{{ route('rooms.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="jurusan_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Jurusan') }}
                </label>
                <select name="jurusan_id" id="jurusan_id" class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="angkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Angkatan') }}
                </label>
                <input type="text" name="angkatan_rooms" id="angkatan_rooms"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                    required>
            </div>

            <div>
                <label for="tahun_ajaran_mulai" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tahun Ajaran Mulai') }}
                </label>
                <input type="date" name="tahun_ajaran_mulai" id="tahun_ajaran_mulai"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <div>
                <label for="tahun_ajaran_berakhir" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tahun Ajaran Berakhir') }}
                </label>
                <input type="date" name="tahun_ajaran_berakhir" id="tahun_ajaran_berakhir"
                    class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600">
            </div>

            <div>
                <label for="tingkatan_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ __('Tingkatan Room') }}
                </label>
                <input type="text" name="tingkatan_rooms" id="tingkatan_rooms"
                       class="w-full mt-1 px-3 py-2 border rounded dark:bg-gray-700 dark:text-white dark:border-gray-600"
                       required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                    {{ __('Create') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
