<section class="w-full">
    {{-- Heading --}}
    <div class="mb-6">
        <div class="flex items-start justify-between mb-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Tolak Jadwal Konseling</h1>
                <p class="text-sm text-gray-600">Masukkan alasan kenapa jadwal ini perlu ditolak.</p>
            </div>
            <div>
                <a href="{{ route('teacher.jadwal-konselings.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-100 text-sm font-medium text-gray-700 rounded hover:bg-gray-200">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="max-w-xl bg-white p-6 shadow-sm rounded-md border">
        <form method="POST" action="{{ route('teacher.jadwal-konselings.reject', $jadwal->id) }}">
            @csrf

            <div class="mb-4">
                <label for="alasan_penolakan" class="block text-sm font-medium text-gray-700 mb-1">
                    Alasan Penolakan <span class="text-red-500">*</span>
                </label>
                <textarea id="alasan_penolakan"
                          name="alasan_penolakan"
                          required
                          rows="5"
                          class="w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
                          placeholder="Tulis alasan penolakan jadwal...">{{ old('alasan_penolakan') }}</textarea>

                @error('alasan_penolakan')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-semibold rounded hover:bg-red-700 focus:outline-none">
                    Tolak Jadwal
                </button>
                <a href="{{ route('teacher.jadwal-konselings.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 text-sm font-medium rounded hover:bg-gray-300">
                    Batal
                </a>
            </div>
        </form>
    </div>
</section>
