<x-layouts.app :title="__('Preview Surat Panggilan')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100 text-center">
            {{ __('Preview Surat Panggilan') }}
        </h1>

        <div class="mb-6 flex flex-col md:flex-row gap-4 justify-center">
            {{-- Tombol Cetak Langsung akan mencetak konten iframe --}}
            <button onclick="printIframe('pdf-frame');" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-md shadow text-base text-center transition duration-300 ease-in-out">
                <i class="fas fa-print mr-2"></i> {{ __('Cetak Langsung') }}
            </button>
            <a href="{{ route('surat_panggilans.download', $surat->id) }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-md shadow text-base text-center transition duration-300 ease-in-out">
                <i class="fas fa-download mr-2"></i> {{ __('Unduh PDF') }}
            </a>
            <a href="{{ route('surat_panggilans.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-md shadow text-base text-center transition duration-300 ease-in-out">
                <i class="fas fa-arrow-left mr-2"></i> {{ __('Kembali') }}
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden h-[calc(100vh-200px)] md:h-[calc(100vh-150px)]">
            {{-- Ini adalah iframe yang akan menampilkan PDF --}}
            <iframe id="pdf-frame" src="{{ route('surat_panggilans.stream_pdf', $surat->id) }}" class="w-full h-full border-0"></iframe>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endpush

    @push('scripts')
        <script>
            function printIframe(id) {
                const iframe = document.getElementById(id);
                if (iframe && iframe.contentWindow) {
                    iframe.contentWindow.focus();
                    iframe.contentWindow.print();
                } else {
                    alert('Tidak dapat mencetak PDF. Pastikan browser mendukung pratinjau PDF.');
                }
            }
        </script>
    @endpush
</x-layouts.app>