<x-layouts.app :title="__('Buat Jadwal Konseling')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Buat Jadwal Konseling') }}</h1>

    <form action="{{ route('penjadwalan.store') }}" method="POST" class="space-y-5">
        @csrf

        <!-- Account Pengirim -->
        <div>
            <label for="account_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Account Pengirim') }}
            </label>
            <input type="text" name="account_pengirim" id="account_pengirim"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                value="{{ auth()->user()->email }}" readonly>
        </div>

        <!-- Nama Pengirim -->
        <div>
            <label for="nama_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nama Pengirim') }}
            </label>
            <input type="text" name="nama_pengirim" id="nama_pengirim"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                placeholder="Opsional">
        </div>

        <!-- Pilih Penerima -->
        <div>
            <label for="penerima_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Pilih Penerima') }}
            </label>
            <select name="penerima_id" id="penerima_id"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                required>
                <option value="">{{ __('Pilih Penerima') }}</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Penerima -->
        <div>
            <label for="nama_penerima" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Nama Penerima') }}
            </label>
            <input type="text" name="nama_penerima" id="nama_penerima"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                placeholder="Opsional">
        </div>

        <!-- Lokasi -->
        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Lokasi') }}
            </label>
            <input type="text" name="lokasi" id="lokasi"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                required>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Tanggal') }}
            </label>
            <input type="datetime-local" name="tanggal" id="tanggal"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                required>
        </div>

        <!-- Topik Dibahas -->
        <div>
            <label for="topik_dibahas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {{ __('Topik Dibahas') }}
            </label>
            <textarea name="topik_dibahas" id="topik_dibahas" rows="4"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring focus:border-blue-500"
                required></textarea>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit"
                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded shadow transition">
                {{ __('Simpan') }}
            </button>
        </div>
    </form>
</x-layouts.app>
