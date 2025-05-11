<x-layouts.app :title="__('Users')">
    <div class="mb-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('Create User') }}</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('Name') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Biodata') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($user->biodata)
                            
                            <a href="{{ route('users.downloadBiodata', $user) }}" class="btn btn-sm btn-success">
                                <span class="text-green-500">{{ __('Completed') }}</span>
                            </a>
                        @else
                            <span class="text-red-500">{{ __('Not Completed') }}</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($user->biodata)
                            <a href="{{ route('users.biodata', $user) }}" class="btn btn-sm btn-info">{{ __('View Biodata') }}</a>
                        @else
                            <span class="text-red-500">{{ __('Biodata not available') }}</span>
                        @endif
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</x-layouts.app>