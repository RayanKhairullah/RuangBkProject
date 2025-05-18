<x-layouts.app :title="__('Jadwal Konseling')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Jadwal Konseling Siswa') }}</h1>

    @if(auth()->user()->role === App\Enums\UserRole::User)
        <a href="{{ route('penjadwalan.create') }}" class="btn btn-primary mb-4">{{ __('Buat Jadwal') }}</a>
    @endif
    
    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
        <a href="{{ route('penjadwalan.download') }}" class="btn btn-primary mb-4">{{ __('Download Semua Jadwal') }}</a>
    @endif

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