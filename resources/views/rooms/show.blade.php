<x-layouts.app :title="__('Room Details')">
    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
    </div>

    <h1 class="text-2xl font-bold">{{ __('Kode Kelas: ') . $room->kode_rooms }}</h1>
    <p>{{ __('Jurusan: ') . $room->jurusan->nama_jurusan }}</p>
    <p>{{ __('Tingkatan Kelas: ') . $room->tingkatan_rooms }}</p>

    <h2 class="text-xl font-bold mt-4">{{ __('Anggota Kelas') }}</h2>
    <table class="table-auto w-full mt-2">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Biodata') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->biodata)
                            
                            <a href="{{ route('users.downloadBiodata', $user) }}" class="btn btn-sm btn-success">
                                <span class="text-green-500">{{ __('Completed') }}</span>
                            </a>
                        @else
                            <span class="text-red-500">{{ __('Not Completed') }}</span>
                        @endif
                                                @if ($user->biodata)
                            <a href="{{ route('users.biodata', $user) }}" class="btn btn-sm btn-info">{{ __('View Biodata') }}</a>
                        @else
                            <span class="text-red-500">{{ __('Biodata not available') }}</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layouts.app>