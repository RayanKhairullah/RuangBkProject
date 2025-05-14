<x-layouts.app :title="__('Detail Surat Panggilan')">
    <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Detail Surat Panggilan') }}</h1>

        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-600">
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
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __($label) }}</th>
                    <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $value }}</td>
                </tr>
            @endforeach
        </table>

        <div class="mt-6 flex justify-end space-x-4">
            <a href="{{ route('surat-panggilan.download', $suratPanggilan->id) }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md">
                {{ __('Download PDF') }}
            </a>
            <a href="{{ route('surat-panggilan.edit', $suratPanggilan) }}" class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-lg shadow-md">
                {{ __('Edit') }}
            </a>
            <a href="{{ route('surat-panggilan.index') }}" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md">
                {{ __('Back') }}
            </a>
        </div>
    </div>
</x-layouts.app>