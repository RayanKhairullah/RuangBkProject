<x-layouts.app :title="__('Jadwal Konseling')">
    <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 py-10 px-2">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                <h1 class="text-2xl md:text-3xl font-bold text-orange-500 dark:text-orange-300">{{ __('Jadwal Konseling Siswa') }}</h1>
                <div class="flex gap-2 flex-wrap">
                    @if(auth()->user()->role === App\Enums\UserRole::User)
                        <a href="{{ route('penjadwalan.create') }}"
                           class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-full font-semibold shadow transition mb-2 md:mb-0">
                            {{ __('Buat Jadwal') }}
                        </a>
                    @endif
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                        <a href="{{ route('penjadwalan.download') }}"
                           class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full font-semibold shadow transition mb-2 md:mb-0">
                            {{ __('Download Semua Jadwal') }}
                        </a>
                    @endif
                </div>
            </div>

            <form method="GET" action="{{ route('penjadwalan.index') }}" class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-wrap gap-4 items-end border border-indigo-100 dark:border-indigo-800">
                {{-- Penerima (Guru) --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Guru Penerima</label>
                    <select name="penerima" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                        <option value="">{{ __('Semua Guru') }}</option>
                        @foreach(\App\Models\User::where('role', App\Enums\UserRole::Teacher)->get() as $guru)
                            <option value="{{ $guru->id }}" @selected(request('penerima') == $guru->id)>
                                {{ $guru->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Lokasi --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}"
                           placeholder="Cari Lokasi…" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                           class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
                </div>

                {{-- Status (hanya guru) --}}
                @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Status</label>
                    <select name="status" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                        <option value="">{{ __('Semua Status') }}</option>
                        <option value="Complete" @selected(request('status')==='Complete')>Complete</option>
                        <option value="Incomplete" @selected(request('status')==='Incomplete')>Incomplete</option>
                    </select>
                </div>
                @endif

                <div class="flex gap-2 mt-2 md:mt-0">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Filter') }}
                    </button>
                    <a href="{{ route('penjadwalan.index') }}"
                       class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition">
                       {{ __('Reset') }}
                    </a>
                </div>
            </form>
            
            <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
                <table class="table-auto w-full border-collapse">
                    <thead>
                        <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                            @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                <th class="border-b px-4 py-3 text-left">{{ __('Account Pengirim') }}</th>
                            @endif
                            <th class="border-b px-4 py-3 text-left">{{ __('Account Penerima') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Nama Pengirim') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Nama Penerima') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Lokasi') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Tanggal & Waktu') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Topik Dibahas') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Solusi') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Status Konseling') }}</th>
                            <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                                @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                    <td class="border-b px-4 py-2">{{ $jadwal->pengirim->email }}</td>
                                @endif
                                <td class="border-b px-4 py-2">{{ $jadwal->penerima->email }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->nama_pengirim }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->nama_penerima }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->lokasi }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->tanggal }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->topik_dibahas }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->solusi ?? '-' }}</td>
                                <td class="border-b px-4 py-2">{{ $jadwal->status }}</td>
                                <td class="border-b px-4 py-2 space-x-1">
                                    <a href="{{ route('penjadwalan.edit', $jadwal->id) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('Edit') }}
                                    </a>
                                    <form action="{{ route('penjadwalan.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition"
                                            onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                    <form action="{{ route('penjadwalan.send', $jadwal->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                            {{ __('Kirim Email') }}
                                        </button>
                                    </form>
                                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                        <a href="{{ route('penjadwalan.show', $jadwal->id) }}"
                                           class="inline-block bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                            {{ __('Lihat Jadwal') }}
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%" class="text-center text-gray-500 dark:text-gray-300 py-8">{{ __('Tidak ada data jadwal.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $jadwals->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-layouts.app>