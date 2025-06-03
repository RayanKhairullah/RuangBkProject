<div class="space-y-6">
  <h1 class="text-3xl font-bold text-gray-800 dark:text-white">{{ __('Riwayat Catatan') }}</h1>

  <div class="overflow-x-auto">
    <table class="table-auto w-full border-collapse border border-gray-300">
      <thead class="bg-black-100">
        <tr>
          <th class="border px-4 py-2">{{ __('Nama Siswa') }}</th>
          <th class="border px-4 py-2">{{ __('Jurusan Siswa') }}</th>
          <th class="border px-4 py-2">{{ __('Kasus/Masalah') }}</th>
          <th class="border px-4 py-2">{{ __('Tanggal') }}</th>
          @if(auth()->user()->role === App\Enums\UserRole::Teacher)
            <th class="border px-4 py-2">{{ __('Email Guru') }}</th>
          @endif
          <th class="border px-4 py-2">{{ __('Guru Pembimbing') }}</th>
          <th class="border px-4 py-2">{{ __('Catatan Guru') }}</th>
          <th class="border px-4 py-2">{{ __('Poin') }}</th>
          @if(auth()->user()->role === App\Enums\UserRole::Teacher)
            <th class="border px-4 py-2">{{ __('Actions') }}</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @forelse ($catatans as $catatan)
          <tr>
            <td class="border px-4 py-2">{{ $catatan->nama_siswa ?? '-' }}</td>
            <td class="border px-4 py-2">
              {{ optional($catatan->room)->kode_rooms ?? '-' }} —
              {{ optional($catatan->room->jurusan)->nama_jurusan ?? '-' }} —
              {{ optional($catatan->room)->tingkatan_rooms ?? '-' }}
            </td>
            <td class="border px-4 py-2">{{ $catatan->kasus ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $catatan->tanggal->format('Y-m-d') ?? now()->format('Y-m-d') }}</td>
            @if(auth()->user()->role === App\Enums\UserRole::Teacher)
              <td class="border px-4 py-2">{{ $catatan->guru->email ?? '-' }}</td>
            @endif
            <td class="border px-4 py-2">{{ $catatan->guru_pembimbing ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $catatan->catatan_guru ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $catatan->poin ?? 0 }}</td>
            @if(auth()->user()->role === App\Enums\UserRole::Teacher)
              <td class="border px-4 py-2 space-x-1">
                <a href="{{ route('catatans.edit', $catatan) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                <a href="{{ route('catatans.show', $catatan) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                <form action="{{ route('catatans.destroy', $catatan) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">{{ __('Hapus') }}</button>
                </form>
              </td>
            @endif
          </tr>
        @empty
          <tr>
            <td colspan="9" class="border px-4 py-2 text-center">Tidak ada riwayat Masalah.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
    <div class="mt-4">
      {{ $catatans->links('pagination::tailwind') }}
    </div>
  </div>
</div>
