<div>
    <div class="flex flex-wrap gap-4 mb-4">
        <div>
            <input
                wire:model.debounce.300ms="searchName"
                type="text"
                placeholder="Filter by Name..."
                class="border rounded px-2 py-1"
            />
        </div>
        <div>
            <select wire:model="searchRole" class="border rounded px-2 py-1">
                <option value="">{{ __('All Roles') }}</option>
                <option value="user">{{ __('User') }}</option>
                <option value="teacher">{{ __('Teacher') }}</option>
            </select>
        </div>
        <div>
            <select wire:model="perPage" class="border rounded px-2 py-1">
                <option value="5">5 per page</option>
                <option value="10">10 per page</option>
                <option value="25">25 per page</option>
            </select>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('Name') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email Verified') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Role') }}</th>
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
                        @if ($user->email_verified_at)
                            <span class="text-green-500">{{ __('Verified') }}</span>
                        @else
                            <span class="text-red-500">{{ __('Not Verified') }}</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->role->value) }}</td>
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
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>