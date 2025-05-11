<x-layouts.app :title="__('Biodata of ') . $user->name">
    <div class="mb-4">
        <a href="{{ route('users.index') }}" class="btn btn-secondary">{{ __('Back to Users') }}</a>
    </div>

    <div class="p-4 bg-white rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-4">{{ __('Biodata of ') . $user->name }}</h2>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <tbody>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Nama Siswa') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->nama_siswa }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('NISN') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->nisn }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Jenis Kelamin') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Kelas') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->rooms->kode_rooms ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Jurusan') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->jurusan->nama_jurusan ?? '-' }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Tempat Lahir') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->tempat_lahir }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Tanggal Lahir') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Telepon') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->telepon }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Alamat') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->alamat }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Agama') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->agama }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Golongan Darah') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->gol_darah }}</td>
                </tr>
                <tr>
                    <th class="border px-4 py-2 text-left">{{ __('Status') }}</th>
                    <td class="border px-4 py-2">{{ $biodata->status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>