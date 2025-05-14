<x-layouts.app :title="__('Edit Jadwal Konseling')">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Edit Jadwal Konseling') }}</h1>

    <form action="{{ route('penjadwalan.update', $penjadwalan->id) }}" method="POST" class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        @csrf
        @method('PUT')

        <!-- Lokasi -->
        <div class="mb-4">
            <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Lokasi') }}</label>
            <input type="text" name="lokasi" id="lokasi" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{ $penjadwalan->lokasi }}" required>
        </div>

        <!-- Tanggal -->
        <div class="mb-4">
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</label>
            <input type="datetime-local" name="tanggal" id="tanggal" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" value="{{ $penjadwalan->tanggal }}" required>
        </div>

        <!-- Topik Dibahas -->
        <div class="mb-4">
            <label for="topik_dibahas" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Topik Dibahas') }}</label>
            <textarea name="topik_dibahas" id="topik_dibahas" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" rows="4" required>{{ $penjadwalan->topik_dibahas }}</textarea>
        </div>

        <!-- Solusi -->
        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
            <div class="mb-4">
                <label for="solusi" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Solusi') }}</label>
                <textarea name="solusi" id="solusi" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" rows="4">{{ $penjadwalan->solusi }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</label>
                <select name="status" id="status" class="form-input mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500">
                    <option value="Incomplete" {{ $penjadwalan->status === 'Incomplete' ? 'selected' : '' }}>{{ __('Incomplete') }}</option>
                    <option value="Complete" {{ $penjadwalan->status === 'Complete' ? 'selected' : '' }}>{{ __('Complete') }}</option>
                </select>
            </div>
        @endif

        <button type="submit" class="w-full px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Simpan Perubahan') }}
        </button>
    </form>
</x-layouts.app>