<x-layouts.app :title="__('Jurusan')">
    <div class="mb-4">
        <a href="{{ route('jurusans.create') }}" class="btn btn-primary">{{ __('Create Jurusan') }}</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('ID') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Nama Jurusan') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jurusans as $jurusan)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $jurusan->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $jurusan->nama_jurusan }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ route('jurusans.show', $jurusan) }}" class="btn btn-sm btn-primary">{{ __('View') }}</a>
                            <a href="{{ route('jurusans.edit', $jurusan) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('jurusans.destroy', $jurusan) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

        <!-- Tampilkan tautan pagination -->
    <div class="mt-4">
        {{ $jurusans->links('pagination::tailwind') }}
    </div>
</x-layouts.app>