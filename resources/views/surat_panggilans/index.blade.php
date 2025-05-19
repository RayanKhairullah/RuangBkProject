<x-layouts.app :title="__('Surat Panggilan')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-10 px-2">
        <div class="max-w-5xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300">{{ __('Daftar Surat Panggilan') }}</h1>
                <a href="{{ route('surat_panggilans.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-semibold shadow transition text-center">
                    {{ __('Buat Surat Panggilan') }}
                </a>
            </div>

            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                            <th class="border-b px-4 py-3 text-left">ID</th>
                            <th class="border-b px-4 py-3 text-left">Nama Siswa</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Jurusan') }}</th>
                            <th class="border-b px-4 py-3 text-left">Nomor Surat</th>
                            <th class="border-b px-4 py-3 text-left">Tanggal &amp; Waktu</th>
                            <th class="border-b px-4 py-3 text-left">Tempat</th>
                            <th class="border-b px-4 py-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($suratPanggilans as $sp)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                <td class="border-b px-4 py-2">{{ $sp->id }}</td>
                                <td class="border-b px-4 py-2">{{ $sp->nama_siswa }}</td>
                                <td class="border-b px-4 py-2">
                                    @if($sp->room)
                                        {{ $sp->room->kode_rooms }}
                                        - {{ $sp->room->jurusan->nama_jurusan }}
                                        - {{ $sp->room->tingkatan_rooms }}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="border-b px-4 py-2">{{ $sp->nomor_surat }}</td>
                                <td class="border-b px-4 py-2">{{ $sp->tanggal_waktu->format('d-m-Y H:i') }}</td>
                                <td class="border-b px-4 py-2">{{ $sp->tempat }}</td>
                                <td class="border-b px-4 py-2 space-x-1">
                                    <a href="{{ route('surat_panggilans.download', $sp->id) }}"
                                       class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                        {{ __('Download') }}
                                    </a>
                                    <a href="{{ route('surat_panggilans.edit', $sp) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('surat_panggilans.destroy', $sp) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                            Hapus
                                        </button>
                                    </form>
                                    <a href="{{ route('surat_panggilans.show', $sp) }}"
                                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-gray-500 dark:text-gray-300 py-8">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $suratPanggilans->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>