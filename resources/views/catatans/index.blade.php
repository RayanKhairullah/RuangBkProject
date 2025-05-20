<x-layouts.app :title="__('Catatan Siswa')">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">{{ __('Catatan Siswa') }}</h1>

    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
    <form method="GET" action="{{ route('catatans.index') }}" class="mb-6 p-4 bg-white dark:bg-gray-800 shadow rounded-lg space-y-4 md:space-y-0 md:flex md:flex-wrap md:gap-4">
        {{-- Siswa --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Siswa</label>
            <select name="siswa" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white">
                <option value="">{{ __('Semua Siswa') }}</option>
                @foreach($students as $s)
                    <option value="{{ $s->id }}" @selected(request('siswa') == $s->id)>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Room --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Kelas</label>
            <select name="room" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white">
                <option value="">{{ __('Semua Kelas') }}</option>
                @foreach($rooms as $r)
                    <option value="{{ $r->id }}" @selected(request('room') == $r->id)>{{ $r->kode_rooms }} - {{ $r->jurusan->nama_jurusan }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal --}}
        <div class="flex-1 min-w-[150px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>

        {{-- Poin --}}
        <div class="flex-1 min-w-[100px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poin Min</label>
            <input type="number" name="poin_min" value="{{ request('poin_min') }}" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>
        <div class="flex-1 min-w-[100px]">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Poin Max</label>
            <input type="number" name="poin_max" value="{{ request('poin_max') }}" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" />
        </div>

        {{-- Buttons --}}
        <div class="flex items-end gap-2">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('catatans.index') }}" class="border px-4 py-2 rounded-md text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">
                {{ __('Reset') }}
            </a>
        </div>
    </form>
    @endif

    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
    <div class="mb-6 flex flex-col md:flex-row gap-4">
        <a href="{{ route('catatans.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">{{ __('Buat Catatan') }}</a>
        <a href="{{ route('catatans.downloadAll') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">{{ __('Download Semua Catatan') }}</a>
    </div>

    <form action="{{ route('catatans.downloadByUser') }}" method="POST" class="mb-6 p-4 bg-white dark:bg-gray-800 shadow rounded-lg flex flex-col md:flex-row items-start md:items-end gap-4">
        @csrf
        <div class="w-full md:w-2/3">
            <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Pilih Siswa') }}</label>
            <select name="nama_siswa" id="nama_siswa" class="w-full px-3 py-2 border rounded-md bg-white dark:bg-gray-700 dark:text-white" required>
                <option value="" disabled selected>{{ __('-- Pilih Data Siswa --') }}</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" @if(old('nama_siswa') == $student->id) selected @endif>{{ $student->name }} ({{ $student->email }})</option>
                @endforeach
            </select>
            @error('nama_siswa')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-md">
                {{ __('Download Data Siswa') }}
            </button>
        </div>
    </form>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto bg-white dark:bg-gray-900 rounded-lg shadow">
        <table class="w-full table-auto text-sm">
            <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                <tr>
                    <th class="px-4 py-2 border">{{ __('Email Siswa') }}</th>
                    <th class="px-4 py-2 border">{{ __('Nama Siswa') }}</th>
                    <th class="px-4 py-2 border">{{ __('Jurusan Siswa') }}</th>
                    <th class="px-4 py-2 border">{{ __('Kasus/Masalah') }}</th>
                    <th class="px-4 py-2 border">{{ __('Tanggal') }}</th>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="px-4 py-2 border">{{ __('Email Guru') }}</th>
                    @endif
                    <th class="px-4 py-2 border">{{ __('Guru Pembimbing') }}</th>
                    <th class="px-4 py-2 border">{{ __('Catatan Guru') }}</th>
                    <th class="px-4 py-2 border">{{ __('Poin') }}</th>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="px-4 py-2 border">{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody class="text-gray-700 dark:text-gray-200">
                @forelse ($catatans as $catatan)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                    <td class="px-4 py-2 border">{{ $catatan->user->email ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $catatan->nama_siswa ?? '-' }}</td>
                    <td class="px-4 py-2 border">
                        {{ $catatan->room->kode_rooms ?? '-' }} -
                        {{ $catatan->room->jurusan->nama_jurusan ?? '-' }} -
                        {{ $catatan->room->tingkatan_rooms ?? '-' }}
                    </td>
                    <td class="px-4 py-2 border">{{ $catatan->kasus ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $catatan->tanggal ?? now()->format('Y-m-d') }}</td>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                        <td class="px-4 py-2 border">{{ $catatan->guru->email ?? '-' }}</td>
                    @endif
                    <td class="px-4 py-2 border">{{ $catatan->guru_pembimbing ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $catatan->catatan_guru ?? '-' }}</td>
                    <td class="px-4 py-2 border">{{ $catatan->poin ?? 0 }}</td>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                       <td class="px-4 py-2 border space-x-1 flex flex-wrap gap-1">
                        <a href="{{ route('catatans.edit', $catatan->id) }}"
                        class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm transition">
                        {{ __('Edit') }}
            </a>
        <form action="{{ route('catatans.destroy', $catatan->id) }}" method="POST" onsubmit="return confirm('{{ __('Yakin ingin menghapus?') }}')">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="inline-block bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">
            {{ __('Hapus') }}
        </button>
    </form>
</td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center text-gray-500 py-4 dark:text-gray-400">{{ __('Tidak ada data catatan.') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $catatans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>