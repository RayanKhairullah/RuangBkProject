<x-layouts.app :title="__('Detail Surat Panggilan')">
    <div class="mb-6 flex flex-wrap gap-3 items-center">
    <a href="{{ route('surat_panggilans.create') }}"
       class="px-4 py-2 rounded text-white bg-blue-600 hover:bg-blue-700 shadow">
        {{ __('Buat Surat') }}
    </a>

    <a href="{{ route('surat_panggilans.edit', $suratPanggilan) }}"
       class="px-4 py-2 rounded text-white bg-yellow-500 hover:bg-yellow-600 shadow">
        {{ __('Edit') }}
    </a>

    <form action="{{ route('surat_panggilans.destroy', $suratPanggilan) }}"
          method="POST"
          onsubmit="return confirm('Yakin ingin menghapus?')"
          class="inline">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="px-4 py-2 rounded text-white bg-red-600 hover:bg-red-700 shadow">
            {{ __('Hapus') }}
        </button>
    </form>
</div>


    <div class="bg-white shadow-md rounded-lg p-8 max-w-xl mx-auto">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-white">
            {{ __('Nomor Surat:') }}
            <span class="font-normal">{{ $suratPanggilan->nomor_surat }}</span>
        </h1>

        <div class="space-y-4 text-gray-700 dark:text-gray-300 text-base leading-relaxed">
            <p><strong>{{ __('Nama Siswa:') }}</strong> {{ $suratPanggilan->nama_siswa }}</p>

            <p>
                <strong>{{ __('Jurusan:') }}</strong>
                @if($suratPanggilan->room)
                    {{ $suratPanggilan->room->kode_rooms }} - {{ $suratPanggilan->room->jurusan->nama_jurusan }} - {{ $suratPanggilan->room->tingkatan_rooms }}
                @else
                    -
                @endif
            </p>

            <p><strong>{{ __('Tanggal & Waktu:') }}</strong> {{ $suratPanggilan->tanggal_waktu->format('d-m-Y H:i') }}</p>

            <p><strong>{{ __('Tempat:') }}</strong> {{ $suratPanggilan->tempat }}</p>

            <div>
                <strong>{{ __('Tujuan:') }}</strong>
                <p class="whitespace-pre-wrap mt-1">{{ $suratPanggilan->tujuan }}</p>
            </div>
        </div>
    </div>
</x-layouts.app>