<x-layouts.app :title="__('Jadwal Konseling')">
    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="mb-4 px-4 py-2 bg-green-100 border border-green-400 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Jadwal Konseling') }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('penjadwalan.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
                {{ __('Buat Jadwal') }}
            </a>
            @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                <a href="{{ route('penjadwalan.download') }}" class="px-4 py-2 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-md shadow-md dark:bg-green-600 dark:hover:bg-green-700">
                    {{ __('Download Semua Jadwal') }}
                </a>
            @endif
        </div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Pengirim') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email Pengirim') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Penerima') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email Penerima') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Lokasi') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Topik Dibahas') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Solusi') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Status') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Aksi') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->pengirim->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->pengirim->email }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->penerima->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->penerima->email }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->lokasi }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->tanggal }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->topik_dibahas }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->solusi ?? '-' }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $jadwal->status }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">
                            <div class="flex space-x-2">
                                <a href="{{ route('penjadwalan.edit', $jadwal->id) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow-md">{{ __('Edit') }}</a>
                                
                                <form action="{{ route('penjadwalan.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md" onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">{{ __('Hapus') }}</button>
                                </form>

                                <form action="{{ route('penjadwalan.send', $jadwal->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">{{ __('Send') }}</button>
                                </form>
                                
                                @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                    <a href="{{ route('penjadwalan.show', $jadwal->id) }}" class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-md shadow-md dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-gray-300">{{ __('Show') }}</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $jadwals->links('pagination::tailwind') }}
    </div>
</x-layouts.app>