<x-layouts.app :title="__('Surat Panggilan')">
    <div class="mb-4">
        <a href="{{ route('surat_panggilans.create') }}" class="btn btn-primary">
            {{ __('Buat Surat Panggilan') }}
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-200">
                    <th class="border px-2 py-1">ID</th>
                    <th class="border px-2 py-1">Nama Siswa</th>
                    <th class="border px-2 py-1">{{ __('Jurusan') }}</th>
                    <th class="border px-2 py-1">Nomor Surat</th>
                    <th class="border px-2 py-1">Tanggal &amp; Waktu</th>
                    <th class="border px-2 py-1">Tempat</th>
                    <th class="border px-2 py-1">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suratPanggilans as $sp)
                    <tr>
                        <td class="border px-2 py-1">{{ $sp->id }}</td>
                        <td class="border px-2 py-1">{{ $sp->nama_siswa }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if($sp->room)
                                {{ $sp->room->kode_rooms }}
                                - {{ $sp->room->jurusan->nama_jurusan }}
                                - {{ $sp->room->tingkatan_rooms }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="border px-2 py-1">{{ $sp->nomor_surat }}</td>
                        <td class="border px-2 py-1">{{ $sp->tanggal_waktu->format('d-m-Y H:i') }}</td>
                        <td class="border px-2 py-1">{{ $sp->tempat }}</td>
                        <td class="border px-2 py-1 space-x-1">
                            <a href="{{ route('surat_panggilans.download', $sp->id) }}" class="btn btn-sm btn-success">
                                {{ __('Download') }}
                            </a>
                            <a href="{{ route('surat_panggilans.edit', $sp) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <form action="{{ route('surat_panggilans.destroy', $sp) }}"
                                    method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('surat_panggilans.show', $sp) }}" class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-2">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $suratPanggilans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>