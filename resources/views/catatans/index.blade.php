<x-layouts.app :title="__('Catatan Siswa')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Catatan Siswa') }}</h1>

    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <a href="{{ route('catatans.create') }}" class="btn btn-primary mb-4">{{ __('Buat Catatan') }}</a>
        <a href="{{ route('catatans.downloadAll') }}" class="btn btn-success mb-4">{{ __('Download Semua Catatan') }}</a>

        <form action="{{ route('catatans.downloadByUser') }}" method="POST" class="flex items-center gap-4 mb-4">
            @csrf
            <div class="flex-grow">
                <label for="nama_siswa" class="block text-sm font-medium text-gray-700">{{ __('Pilih Siswa') }}</label>
                <select name="nama_siswa" id="nama_siswa" class="form-input w-full" required>
                    <option value="" disabled selected>{{ __('-- Pilih Data Siswa --') }}</option> <!-- Default placeholder -->
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" @if(old('nama_siswa') == $student->id) selected @endif>
                            {{ $student->name }} ({{ $student->email }})
                        </option>
                    @endforeach
                </select>
                @error('nama_siswa')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="btn btn-secondary mt-6">{{ __('Download Data Siswa') }}</button>
            </div>
        </form>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email Siswa') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Nama Siswa') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Jurusan Siswa') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Kasus/Masalah') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Tanggal') }}</th>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border border-gray-300 px-4 py-1">{{ __('Email Guru') }}</th>
                    @endif
                    <th class="border border-gray-300 px-4 py-1">{{ __('Guru Pembimbing') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Catatan Guru') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Poin') }}</th>
                    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($catatans as $catatan)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->user->email ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->nama_siswa ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $catatan->room->kode_rooms ?? '-' }} -
                            {{ $catatan->room->jurusan->nama_jurusan ?? '-' }} -
                            {{ $catatan->room->tingkatan_rooms ?? '-' }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->kasus ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->tanggal ?? now()->format('Y-m-d') }}</td> <!-- Default to today if missing -->
                        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru->email ?? '-' }}</td>
                        @endif
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru_pembimbing ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->catatan_guru ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->poin ?? 0 }}</td> <!-- Default to 0 points -->
                        @if(auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('catatans.edit', $catatan->id) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                <a href="{{ route('catatans.show', $catatan) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                                <form action="{{ route('catatans.destroy', $catatan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">{{ __('Hapus') }}</button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $catatans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>