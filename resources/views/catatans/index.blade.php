<x-layouts.app :title="__('Catatan Prilaku')">
    <h1 class="text-2xl font-bold mb-4">{{ __('Catatan Prilaku') }}</h1>

    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <a href="{{ route('catatans.downloadAll') }}"
        class="btn btn-success mb-4">
        {{ __('Download Semua Catatan') }}
        </a>
        <form action="{{ route('catatans.downloadByUser') }}" method="POST" class="flex items-center gap-4 mb-4">
                @csrf
                <div class="flex-grow">
                    <label for="nama_siswa" class="block text-sm font-medium text-gray-700">
                        {{ __('Pilih Siswa') }}
                    </label>
                    <select name="nama_siswa" id="nama_siswa" class="form-input w-full" required>
                        <option value="">{{ __('-- Pilih Siswa --') }}</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->name }} ({{ $student->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('nama_siswa')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-secondary mt-6">
                        {{ __('Download per Siswa') }}
                    </button>
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
                    <th class="border border-gray-300 px-4 py-1">{{ __('Tingkatan Kelas') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Kasus') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Tanggal') }}</th>
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border border-gray-300 px-4 py-1">{{ __('Email Guru') }}</th>
                    @endif
                    <th class="border border-gray-300 px-4 py-1">{{ __('Guru Pembimbing') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Catatan Guru') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Poin') }}</th>
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                        <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($catatans as $catatan)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->user->email ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->nama_siswa }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $catatan->room->jurusan->nama_jurusan }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            {{ $catatan->room->tingkatan_rooms }}
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->kasus }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->tanggal }}</td>
                        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru->email ?? '-' }}</td>
                        @endif
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->guru_pembimbing }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->catatan_guru }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $catatan->poin }}</td>
                        @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            <td class="border border-gray-300 px-4 py-2">
                                <a href="{{ route('catatans.edit', $catatan->id) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                                <form action="{{ route('catatans.destroy', $catatan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                        {{ __('Hapus') }}
                                    </button>
                                </form>
                                <a href="{{ route('catatans.show', $catatan->id) }}" class="btn btn-sm btn-warning">{{ __('Show') }}</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>