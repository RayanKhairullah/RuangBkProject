<x-layouts.app :title="__('Detail Surat Panggilan')">
    <div class="mb-4 flex space-x-2">
        <a href="{{ route('surat_panggilans.create') }}" class="btn btn-primary">
            {{ __('Buat Surat') }}
        </a>
        <a href="{{ route('surat_panggilans.edit', $suratPanggilan) }}" class="btn btn-warning">
            {{ __('Edit') }}
        </a>
        <form action="{{ route('surat_panggilans.destroy', $suratPanggilan) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">{{ __('Hapus') }}</button>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">
            {{ __('Nomor Surat:') }} <span class="font-normal">{{ $suratPanggilan->nomor_surat }}</span>
        </h1>

        <div class="space-y-2 text-gray-700">
            <p><strong>{{ __('Nama Siswa:') }}</strong> {{ $suratPanggilan->nama_siswa }}</p>

            <p>
                <strong>{{ __('Jurusan:') }}</strong>
                @if($suratPanggilan->room)
                    {{ $suratPanggilan->room->kode_rooms }}
                    - {{ $suratPanggilan->room->jurusan->nama_jurusan }}
                    - {{ $suratPanggilan->room->tingkatan_rooms }}
                @else
                    -
                @endif
            </p>

            <p>
                <strong>{{ __('Tanggal & Waktu:') }}</strong>
                {{ $suratPanggilan->tanggal_waktu->format('d-m-Y H:i') }}
            </p>
            <p><strong>{{ __('Tempat:') }}</strong> {{ $suratPanggilan->tempat }}</p>
            <p><strong>{{ __('Tujuan:') }}</strong></p>
            <p class="whitespace-pre-wrap">{{ $suratPanggilan->tujuan }}</p>
        </div>
    </div>
</x-layouts.app>
