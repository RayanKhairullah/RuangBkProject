<x-layouts.app :title="__('Catatan Siswa')">
    <div class="max-w-7xl mx-auto py-8 px-2">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <h1 class="text-3xl font-bold text-orange-500 dark:text-orange-300">{{ __('Catatan Siswa') }}</h1>
            @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                <div class="flex gap-2 flex-wrap">
                    <a href="{{ route('catatans.create') }}"
                       class="bg-orange-500 hover:bg-orange-600 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Buat Catatan') }}
                    </a>
                    <a href="{{ route('catatans.downloadAll') }}"
                       class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                        {{ __('Download Semua Catatan') }}
                    </a>
                </div>
            @endif
        </div>

        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <form method="GET" action="{{ route('catatans.index') }}" class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-wrap gap-4 items-end border border-indigo-100 dark:border-indigo-800">
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Siswa</label>
                <select name="siswa" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                    <option value="">{{ __('Semua Siswa') }}</option>
                    @foreach($students as $s)
                        <option value="{{ $s->id }}" @selected(request('siswa') == $s->id)>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Room</label>
                <select name="room" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                    <option value="">{{ __('Semua Kelas') }}</option>
                    @foreach($rooms as $r)
                        <option value="{{ $r->id }}" @selected(request('room') == $r->id)>
                            {{ $r->kode_rooms }} - {{ $r->jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Tanggal</label>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                       class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Poin Min</label>
                <input type="number" name="poin_min" value="{{ request('poin_min') }}"
                       class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition w-24 text-gray-900 dark:text-gray-100" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">Poin Max</label>
                <input type="number" name="poin_max" value="{{ request('poin_max') }}"
                       class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition w-24 text-gray-900 dark:text-gray-100" />
            </div>
            <div class="flex gap-2 mt-2 md:mt-0">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                    {{ __('Filter') }}
                </button>
                <a href="{{ route('catatans.index') }}"
                   class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition">
                   {{ __('Reset') }}
                </a>
            </div>
        </form>
        @endif

        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <form action="{{ route('catatans.downloadByUser') }}" method="POST" class="flex flex-col md:flex-row items-center gap-4 mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-4 border border-indigo-100 dark:border-indigo-800">
            @csrf
            <div class="flex-grow w-full md:w-auto">
                <label for="nama_siswa" class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('Pilih Siswa') }}</label>
                <select name="nama_siswa" id="nama_siswa" class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" required>
                    <option value="" disabled selected>{{ __('-- Pilih Data Siswa --') }}</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" @if(old('nama_siswa') == $student->id) selected @endif>
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>
                @error('nama_siswa')
                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-full font-semibold shadow transition mt-2 md:mt-6">
                    {{ __('Download Data Siswa') }}
                </button>
            </div>
        </form>
        @endif

        <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
            <table class="table-auto w-full border-collapse">
                <thead>
                    <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                        <th class="border-b px-4 py-3 text-left">{{ __('Email Siswa') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Nama Siswa') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Jurusan Siswa') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Kasus/Masalah') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Tanggal') }}</th>
                        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                            <th class="border-b px-4 py-3 text-left">{{ __('Email Guru') }}</th>
                        @endif
                        <th class="border-b px-4 py-3 text-left">{{ __('Guru Pembimbing') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Catatan Guru') }}</th>
                        <th class="border-b px-4 py-3 text-left">{{ __('Poin') }}</th>
                        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                            <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($catatans as $catatan)
                        <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                            <td class="border-b px-4 py-2">{{ $catatan->user->email ?? '-' }}</td>
                            <td class="border-b px-4 py-2">{{ $catatan->nama_siswa ?? '-' }}</td>
                            <td class="border-b px-4 py-2">
                                {{ $catatan->room->kode_rooms ?? '-' }} -
                                {{ $catatan->room->jurusan->nama_jurusan ?? '-' }} -
                                {{ $catatan->room->tingkatan_rooms ?? '-' }}
                            </td>
                            <td class="border-b px-4 py-2">{{ $catatan->kasus ?? '-' }}</td>
                            <td class="border-b px-4 py-2">{{ $catatan->tanggal ?? now()->format('Y-m-d') }}</td>
                            @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                                <td class="border-b px-4 py-2">{{ $catatan->guru->email ?? '-' }}</td>
                            @endif
                            <td class="border-b px-4 py-2">{{ $catatan->guru_pembimbing ?? '-' }}</td>
                            <td class="border-b px-4 py-2">{{ $catatan->catatan_guru ?? '-' }}</td>
                            <td class="border-b px-4 py-2">{{ $catatan->poin ?? 0 }}</td>
                            @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                                <td class="border-b px-4 py-2 space-x-1">
                                    <a href="{{ route('catatans.edit', $catatan->id) }}"
                                       class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('Edit') }}
                                    </a>
                                    <a href="{{ route('catatans.show', $catatan) }}"
                                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition">
                                        {{ __('View') }}
                                    </a>
                                    <form action="{{ route('catatans.destroy', $catatan->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition"
                                            onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                            {{ __('Hapus') }}
                                        </button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center text-gray-500 dark:text-gray-300 py-8">{{ __('Tidak ada data catatan.') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-center">
            {{ $catatans->links('pagination::tailwind') }}
        </div>
    </div>
</x-layouts.app>