<x-layouts.app :title="__('Room Details')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex flex-col items-center py-10 px-2">
        <div class="w-full max-w-3xl">
            <div class="mb-6 flex items-center gap-2">
                <a href="{{ route('rooms.index') }}"
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                    &larr; {{ __('Kembali ke Daftar Room') }}
                </a>
                <a href="{{ route('rooms.create') }}"
                   class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full font-semibold shadow transition text-sm">
                    {{ __('Tambah Room') }}
                </a>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-indigo-100 dark:border-indigo-800 p-8 mb-8">
                <h1 class="text-2xl font-bold text-orange-500 dark:text-orange-300 mb-2 text-center">
                    {{ __('Kode Kelas:') }} <span class="text-indigo-700 dark:text-indigo-300">{{ $room->kode_rooms }}</span>
                </h1>
                <div class="flex flex-col md:flex-row md:justify-center md:gap-8 text-center md:text-left">
                    <p class="text-gray-700 dark:text-gray-200 mb-2 md:mb-0">{{ __('Jurusan: ') }}<span class="font-semibold">{{ $room->jurusan->nama_jurusan }}</span></p>
                    <p class="text-gray-700 dark:text-gray-200">{{ __('Tingkatan Kelas: ') }}<span class="font-semibold">{{ $room->tingkatan_rooms }}</span></p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800 p-6">
                <h2 class="text-xl font-bold text-indigo-700 dark:text-indigo-300 mb-4 text-center">{{ __('Anggota Kelas') }}</h2>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                                <th class="border-b px-4 py-3 text-left">{{ __('Name') }}</th>
                                <th class="border-b px-4 py-3 text-left">{{ __('Email') }}</th>
                                <th class="border-b px-4 py-3 text-left">{{ __('Biodata') }}</th>
                                <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                    <td class="border-b px-4 py-2">{{ $user->name }}</td>
                                    <td class="border-b px-4 py-2">{{ $user->email }}</td>
                                    <td class="border-b px-4 py-2">
                                        @if ($user->biodata)
                                            <a href="{{ route('users.downloadBiodata', $user) }}"
                                               class="inline-block bg-green-100 dark:bg-green-900 hover:bg-green-200 dark:hover:bg-green-800 text-green-700 dark:text-green-200 px-3 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                                {{ __('Download') }}
                                            </a>
                                            <a href="{{ route('users.biodata', $user) }}"
                                               class="inline-block bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-700 dark:text-blue-200 px-3 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                                {{ __('View Biodata') }}
                                            </a>
                                        @else
                                            <span class="inline-block bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-200 px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                                {{ __('Belum Lengkap') }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="border-b px-4 py-2">
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-1 rounded-full text-xs font-semibold shadow transition"
                                                onclick="return confirm('{{ __('Are you sure?') }}')">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>