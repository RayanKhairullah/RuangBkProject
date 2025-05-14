<x-layouts.app :title="__('Buat Jadwal Konseling')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Buat Jadwal Konseling') }}</h1>

    <form action="{{ route('penjadwalan.store') }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf

        <!-- Pilih Penerima -->
        <div class="mb-4">
            <label for="penerima_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Pilih Penerima') }}
            </label>
            <select name="penerima_id" id="penerima_id" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
                <option value="">{{ __('Pilih Penerima') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Lokasi -->
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Lokasi') }}</label>
            <input type="text" name="lokasi" id="lokasi" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <!-- Topik Dibahas -->
        <div class="mb-4">
            <label for="topik_dibahas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Topik Dibahas') }}</label>
            <textarea name="topik_dibahas" id="topik_dibahas" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" rows="4" required></textarea>
        </div>

        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Simpan') }}
        </button>
    </form>
</x-layouts.app>