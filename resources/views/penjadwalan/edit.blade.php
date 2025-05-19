<x-layouts.app :title="__('Edit Jadwal Konseling')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 max-w-lg w-full p-8">
            <h1 class="text-2xl md:text-3xl font-bold text-orange-500 dark:text-orange-300 mb-6 text-center">{{ __('Edit Jadwal Konseling') }}</h1>
            <form action="{{ route('penjadwalan.update', $penjadwalan->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Lokasi') }}</label>
                    <input type="text" name="lokasi" id="lokasi"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ $penjadwalan->lokasi }}" required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Tanggal') }}</label>
                    <input type="datetime-local" name="tanggal" id="tanggal"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ $penjadwalan->tanggal }}" required>
                </div>

                <!-- Topik Dibahas -->
                <div>
                    <label for="topik_dibahas" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Topik Dibahas') }}</label>
                    <textarea name="topik_dibahas" id="topik_dibahas"
                        class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        rows="4" required>{{ $penjadwalan->topik_dibahas }}</textarea>
                </div>
                
                <!-- Nama Pengirim -->
                <div>
                    <label for="nama_pengirim" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nama Pengirim') }}</label>
                    <input type="text" name="nama_pengirim" id="nama_pengirim"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ $penjadwalan->nama_pengirim }}" placeholder="Opsional">
                </div>

                <!-- Nama Penerima -->
                <div>
                    <label for="nama_penerima" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Nama Penerima') }}</label>
                    <input type="text" name="nama_penerima" id="nama_penerima"
                        class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                        value="{{ $penjadwalan->nama_penerima }}" placeholder="Opsional">
                </div>

                <!-- Solusi -->
                @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                    <div>
                        <label for="solusi" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Solusi') }}</label>
                        <textarea name="solusi" id="solusi"
                            class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                            rows="4">{{ $penjadwalan->solusi }}</textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">{{ __('Status') }}</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                            <option value="Incomplete" {{ $penjadwalan->status === 'Incomplete' ? 'selected' : '' }}>{{ __('Incomplete') }}</option>
                            <option value="Complete" {{ $penjadwalan->status === 'Complete' ? 'selected' : '' }}>{{ __('Complete') }}</option>
                        </select>
                    </div>
                @endif

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Simpan Perubahan') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>