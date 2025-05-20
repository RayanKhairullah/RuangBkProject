<x-layouts.app :title="__('Room Details')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
            {{ __('Detail Kelas') }}
        </h1>
        <a href="{{ route('rooms.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            {{ __('+ Tambah Kelas') }}
        </a>
    </div>

    {{-- Info Room --}}
    <div class="bg-white dark:bg-gray-800 rounded shadow p-4 mb-6">
        <p class="text-lg text-gray-800 dark:text-white font-semibold">
            {{ __('Kode Kelas: ') }} <span class="font-normal">{{ $room->kode_rooms }}</span>
        </p>
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('Jurusan: ') . $room->jurusan->nama_jurusan }}
        </p>
        <p class="text-gray-700 dark:text-gray-300">
            {{ __('Tingkatan Kelas: ') . $room->tingkatan_rooms }}
        </p>
    </div>

    {{-- Anggota Kelas --}}
    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-2">{{ __('Anggota Kelas') }}</h2>
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 uppercase">
                <tr>
                    <th class="px-4 py-2 border">{{ __('Nama') }}</th>
                    <th class="px-4 py-2 border">{{ __('Email') }}</th>
                    <th class="px-4 py-2 border">{{ __('Biodata') }}</th>
                    <th class="px-4 py-2 border">{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="px-4 py-2 border">{{ $user->name }}</td>
                        <td class="px-4 py-2 border">{{ $user->email }}</td>
                        <td class="px-4 py-2 border space-y-1">
                            @if ($user->biodata)
                                <a href="{{ route('users.downloadBiodata', $user) }}"
                                   class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded text-xs hover:bg-green-200">
                                   {{ __('Download') }}
                                </a>
                                <a href="{{ route('users.biodata', $user) }}"
                                   class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded text-xs hover:bg-blue-200">
                                   {{ __('Lihat') }}
                                </a>
                            @else
                                <span class="text-red-500 text-xs italic">{{ __('Belum Lengkap') }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 border">
                            <form action="{{ route('users.destroy', $user) }}" method="POST"
                                  onsubmit="return confirm('{{ __('Apakah Anda yakin ingin menghapus user ini?') }}')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-xs shadow">
                                    {{ __('Hapus') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4 dark:text-gray-400">
                            {{ __('Belum ada anggota di kelas ini.') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-layouts.app>