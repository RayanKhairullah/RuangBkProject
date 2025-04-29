<x-layouts.app :title="__('Detail Surat Panggilan')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Detail Surat Panggilan') }}</h1>

    <table class="table-auto w-full border border-gray-300">
        @foreach ([
            'Nomor Surat'        => $suratPanggilan->nomor_surat,
            'Nama Siswa'         => $suratPanggilan->siswa->biodata->user->name,
            'Kelas'              => $suratPanggilan->siswa->biodata->rooms->tingkatan_rooms,
            'NISN'               => $suratPanggilan->siswa->biodata->nisn,
            'Penyebab'           => $suratPanggilan->penyebab,
            'Tanggal'            => $suratPanggilan->tanggal->format('d-m-Y'),
            'Waktu'              => $suratPanggilan->waktu,
            'Tempat'             => $suratPanggilan->tempat,
            'Tujuan Pertemuan'   => $suratPanggilan->tujuan,
            'Dibuat'             => $suratPanggilan->created_at->diffForHumans(),
        ] as $label => $value)
            <tr>
                <th class="border px-4 py-2 text-left">{{ __($label) }}</th>
                <td class="border px-4 py-2">{{ $value }}</td>
            </tr>
        @endforeach
    </table>

    <div class="mt-4 space-x-2">
        <a href="{{ route('surat-panggilan.download', $suratPanggilan->id) }}" class="btn btn-success">{{ __('Download PDF') }}</a>
        <a href="{{ route('surat-panggilan.edit', $suratPanggilan) }}" class="btn btn-warning">{{ __('Edit') }}</a>
        <a href="{{ route('surat-panggilan.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>
    </div>
</x-layouts.app>