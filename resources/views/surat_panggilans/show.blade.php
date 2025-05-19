<x-layouts.app :title="__('Detail Surat Panggilan')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex flex-col items-center py-10 px-2">
        <div class="w-full max-w-xl">
            <div class="mb-6 flex flex-wrap gap-2 justify-end">
                <a href="{{ route('surat_panggilans.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                    {{ __('Buat Surat') }}
                </a>
                <a href="{{ route('surat_panggilans.edit', $suratPanggilan) }}"
                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                    {{ __('Edit') }}
                </a>
                <form action="{{ route('surat_panggilans.destroy', $suratPanggilan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                        {{ __('Hapus') }}
                    </button>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 p-8">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-4 text-center">
                    {{ __('Nomor Surat:') }} <span class="font-normal text-indigo-700 dark:text-indigo-300">{{ $suratPanggilan->nomor_surat }}</span>
                </h1>
                <div class="space-y-3 text-gray-700 dark:text-gray-200 text-base">
                    <div>
                        <span class="font-semibold">{{ __('Nama Siswa:') }}</span>
                        <span>{{ $suratPanggilan->nama_siswa }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">{{ __('Jurusan:') }}</span>
                        @if($suratPanggilan->room)
                            <span>{{ $suratPanggilan->room->kode_rooms }} - {{ $suratPanggilan->room->jurusan->nama_jurusan }} - {{ $suratPanggilan->room->tingkatan_rooms }}</span>
                        @else
                            <span>-</span>
                        @endif
                    </div>
                    <div>
                        <span class="font-semibold">{{ __('Tanggal & Waktu:') }}</span>
                        <span>{{ $suratPanggilan->tanggal_waktu->format('d-m-Y H:i') }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">{{ __('Tempat:') }}</span>
                        <span>{{ $suratPanggilan->tempat }}</span>
                    </div>
                    <div>
                        <span class="font-semibold">{{ __('Tujuan:') }}</span>
                        <div class="bg-indigo-50 dark:bg-gray-700 rounded-xl p-4 mt-1 whitespace-pre-wrap text-gray-700 dark:text-gray-200">{{ $suratPanggilan->tujuan }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>