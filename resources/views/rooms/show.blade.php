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
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Email') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Email Verify') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Role') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Status Biodata') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 dark:text-gray-200">
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm dark:text-gray-200">
                            @if ($user->email_verified_at)
                                <span class="text-green-600 font-semibold dark:text-green-400">{{ __('Verified') }}</span>
                            @else
                                <span class="text-red-600 font-semibold dark:text-red-400">{{ __('Not Verified') }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ ucfirst($user->role->value) }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm dark:text-gray-200">
                            @if ($user->biodata)
                                <a href="{{ route('rooms.users.downloadBiodata', ['room' => $room->id, 'user' => $user->id]) }}"
                                    class="inline-block px-3 py-1 text-green-700 bg-green-100 rounded hover:bg-green-200 transition
                                            dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800"
                                >
                                    {{ __('Download') }}
                                </a>
                            @else
                                    <span class="text-red-600 font-semibold dark:text-red-400">{{ __('Not Completed') }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center space-x-2 text-sm dark:text-gray-200">
                            @if ($user->biodata)
                                <!-- Tombol Lihat Biodata -->
                                <a href="{{ route('rooms.users.biodata', ['room' => $room->id, 'user' => $user->id]) }}"
                                    class="inline-block px-3 py-1 rounded-md
                                            bg-blue-100 text-blue-700 hover:bg-blue-200
                                            dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800
                                            transition"
                                >
                                    {{ __('Lihat Biodata') }}
                                </a>
                            @else
                                <span class="text-red-600 dark:text-red-400">{{ __('Biodata not available') }}</span>
                            @endif

                                <!-- Tombol Delete Account -->
                                <form action="{{ route('rooms.users.destroy', ['room' => $room->id, 'user' => $user->id]) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="px-3 py-1 rounded-md
                                                bg-red-600 text-white hover:bg-red-700
                                                dark:bg-red-700 dark:hover:bg-red-600
                                                transition"
                                        onclick="return confirm('{{ __('Are you sure?') }}')"
                                    >
                                        {{ __('Delete Account') }}
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