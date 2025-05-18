<x-layouts.app :title="__('Jadwal Konseling')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Jadwal Konseling Siswa') }}</h1>

    @if(auth()->user()->role === App\Enums\UserRole::User)
        <a href="{{ route('penjadwalan.create') }}" class="btn btn-primary mb-4">{{ __('Buat Jadwal') }}</a>
    @endif
    
    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
        <a href="{{ route('penjadwalan.download') }}" class="btn btn-primary mb-4">{{ __('Download Semua Jadwal') }}</a>
    @endif

    <form method="GET" action="{{ route('penjadwalan.index') }}" class="mb-4 flex flex-wrap gap-3 items-end">
        {{-- Penerima (Guru) --}}
        <div>
            <label class="block text-sm">Guru Penerima</label>
            <select name="penerima" class="px-3 py-1 border rounded">
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
            <label class="block text-sm">Lokasi</label>
            <input type="text" name="lokasi" value="{{ request('lokasi') }}"
                   placeholder="Cari Lokasi…" class="px-3 py-1 border rounded" />
        </div>

        {{-- Tanggal --}}
        <div>
            <label class="block text-sm">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                   class="px-3 py-1 border rounded" />
        </div>

        {{-- Status (hanya guru) --}}
        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <div>
            <label class="block text-sm">Status</label>
            <select name="status" class="px-3 py-1 border rounded">
                <option value="">{{ __('Semua Status') }}</option>
                <option value="Complete" @selected(request('status')==='Complete')>Complete</option>
                <option value="Incomplete" @selected(request('status')==='Incomplete')>Incomplete</option>
            </select>
        </div>
        @endif

        <div class="flex gap-2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('penjadwalan.index') }}"
               class="px-4 py-1 border rounded text-gray-600">
               {{ __('Reset') }}
            </a>
        </div>
    </form>
    
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-200">
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border px-4 py-2">{{ __('Account Pengirim') }}</th>
                    @endif
                    <th class="border px-4 py-2">{{ __('Account Penerima') }}</th>
                    <th class="border px-4 py-2">{{ __('Nama Pengirim') }}</th>
                    <th class="border px-4 py-2">{{ __('Nama Penerima') }}</th>
                    <th class="border px-4 py-2">{{ __('Lokasi') }}</th>
                    <th class="border px-4 py-2">{{ __('Tanggal & Waktu') }}</th>
                    <th class="border px-4 py-2">{{ __('Topik Dibahas') }}</th>
                    <th class="border px-4 py-2">{{ __('Solusi') }}</th>
                    <th class="border px-4 py-2">{{ __('Status Konselling') }}</th>
                    <th class="border px-4 py-2">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border px-4 py-2">{{ $jadwal->pengirim->email }}</td>
                        @endif
                        <td class="border px-4 py-2">{{ $jadwal->penerima->email }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->nama_pengirim }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->nama_penerima }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->lokasi }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->tanggal }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->topik_dibahas }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->solusi ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $jadwal->status }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('penjadwalan.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('penjadwalan.destroy', $jadwal->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">{{ __('Hapus') }}</button>
                            </form>
                            <form action="{{ route('penjadwalan.send', $jadwal->id) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">{{ __('Kirim Email') }}</button>
                            </form>
                            @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                                <a href="{{ route('penjadwalan.show', $jadwal->id) }}" class="btn btn-sm btn-info">{{ __('Lihat Jadwal') }}</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $jadwals->links() }}
    </div>
</x-layouts.app>