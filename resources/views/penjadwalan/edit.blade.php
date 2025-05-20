<x-layouts.app :title="__('Edit Jadwal Konseling')">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">{{ __('Edit Jadwal Konseling') }}</h1>

    <form action="{{ route('penjadwalan.update', $penjadwalan->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Lokasi -->
        <div>
            <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Lokasi') }}</label>
            <input type="text" name="lokasi" id="lokasi"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                value="{{ $penjadwalan->lokasi }}" required>
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</label>
            <input type="datetime-local" name="tanggal" id="tanggal"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                value="{{ \Carbon\Carbon::parse($penjadwalan->tanggal)->format('Y-m-d\TH:i') }}" required>
        </div>

        <!-- Topik Dibahas -->
        <div>
            <label for="topik_dibahas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Topik Dibahas') }}</label>
            <textarea name="topik_dibahas" id="topik_dibahas" rows="4"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                required>{{ $penjadwalan->topik_dibahas }}</textarea>
        </div>

        <!-- Nama Pengirim -->
        <div>
            <label for="nama_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Pengirim') }}</label>
            <input type="text" name="nama_pengirim" id="nama_pengirim"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                value="{{ $penjadwalan->nama_pengirim }}" placeholder="Opsional">
        </div>

        <!-- Nama Penerima -->
        <div>
            <label for="nama_penerima" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Penerima') }}</label>
            <input type="text" name="nama_penerima" id="nama_penerima"
                class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500"
                value="{{ $penjadwalan->nama_penerima }}" placeholder="Opsional">
        </div>

        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
            <!-- Solusi -->
            <div>
                <label for="solusi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Solusi') }}</label>
                <textarea name="solusi" id="solusi" rows="4"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">{{ $penjadwalan->solusi }}</textarea>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
                <select name="status" id="status"
                    class="w-full mt-1 border border-gray-300 dark:border-gray-600 rounded px-3 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
                    <option value="Incomplete" {{ $penjadwalan->status === 'Incomplete' ? 'selected' : '' }}>{{ __('Incomplete') }}</option>
                    <option value="Complete" {{ $penjadwalan->status === 'Complete' ? 'selected' : '' }}>{{ __('Complete') }}</option>
                </select>
            </div>
        @endif

        <div>
            <button type="submit"
                class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded shadow transition">
                {{ __('Simpan Perubahan') }}
            </button>
        </div>
    </form>
</x-layouts.app>
