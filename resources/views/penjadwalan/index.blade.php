<x-layouts.app :title="__('Jadwal Konseling')">
    <div class="space-y-6">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ __('Jadwal Konseling Siswa') }}</h1>

        @if(auth()->user()->role === App\Enums\UserRole::User)
            <a href="{{ route('penjadwalan.create') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
               {{ __('Buat Jadwal') }}
            </a>
        @endif

        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
            <a href="{{ route('penjadwalan.download') }}"
               class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow transition">
               {{ __('Download Semua Jadwal') }}
            </a>
        @endif

        <form method="GET" action="{{ route('penjadwalan.index') }}" class="bg-white dark:bg-gray-800 p-4 rounded shadow space-y-4">
            <div class="grid md:grid-cols-5 sm:grid-cols-2 gap-4">
                {{-- Guru Penerima --}}
                @if(auth()->user()->role === App\Enums\UserRole::User)
                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Guru Penerima</label>
                        <select name="penerima" class="w-full mt-1 px-3 py-2 border dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white">
                            <option value="">{{ __('Semua Guru') }}</option>
                            @foreach(\App\Models\User::where('role', App\Enums\UserRole::Teacher)->get() as $guru)
                                <option value="{{ $guru->id }}" @selected(request('penerima') == $guru->id)>
                                    {{ $guru->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Account Pengirim --}}
                @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                    <div>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Account Pengirim</label>
                        <input type="text" name="pengirim" value="{{ old('pengirim') }}" placeholder="contoh: rayan" 
                            class="w-full mt-1 px-3 py-2 border dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white" />
                    </div>
                @endif
                
                {{-- Lokasi --}}
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Lokasi</label>
                    <input type="text" name="lokasi" value="{{ request('lokasi') }}"
                           placeholder="Cari Lokasi…" class="w-full mt-1 px-3 py-2 border dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white" />
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                           class="w-full mt-1 px-3 py-2 border dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white" />
                </div>

                {{-- Status --}}
                @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                <div>
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" class="w-full mt-1 px-3 py-2 border dark:border-gray-600 rounded dark:bg-gray-700 dark:text-white">
                        <option value="pending" @selected(request('status')==='pending')>Pending</option>
                        <option value="accepted" @selected(request('status')==='accepted')>Accepted</option>
                        <option value="rejected" @selected(request('status')==='rejected')>Rejected</option>
                    </select>
                </div>
                @endif
            </div>

            <div class="flex gap-3">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                    {{ __('Filter') }}
                </button>
                <a href="{{ route('penjadwalan.index') }}"
                   class="px-4 py-2 border dark:border-gray-600 rounded text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                   {{ __('Reset') }}
                </a>
            </div>
        </form>

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded shadow">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200">
                    <tr>
                        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            <th class="px-4 py-2 border dark:border-gray-600">{{ __('Account Pengirim') }}</th>
                        @endif
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Account Penerima') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Nama Pengirim') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Nama Penerima') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Lokasi') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Tanggal & Waktu') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Topik Dibahas') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Solusi') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Status Pengajuan') }}</th>
                        <th class="px-4 py-2 border dark:border-gray-600">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800 dark:text-gray-100">
                    @forelse ($jadwals as $jadwal)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->pengirim->email }}</td>
                            @endif
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->penerima->email }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->nama_pengirim }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->nama_penerima }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->lokasi }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->tanggal }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->topik_dibahas }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->solusi ?? '-' }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600">{{ $jadwal->status }}</td>
                            <td class="border px-4 py-2 dark:border-gray-600 space-y-2">
                                <a href="{{ route('penjadwalan.edit', $jadwal->id) }}"
                                   class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm shadow transition">
                                   {{ __('Edit') }}
                                </a>

                                @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                    <form action="{{ route('penjadwalan.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-block bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm shadow transition"
                                                onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                @endif

                                @if (auth()->user()->role === App\Enums\UserRole::User)
                                    <form action="{{ route('penjadwalan.send', $jadwal->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit"
                                                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm shadow transition">
                                            {{ __('Kirim Email') }}
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-gray-500 dark:text-gray-400 py-4">{{ __('Tidak ada data ditemukan.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $jadwals->links() }}
        </div>
    </div>
</x-layouts.app>
