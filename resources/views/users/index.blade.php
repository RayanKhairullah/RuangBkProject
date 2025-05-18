<x-layouts.app :title="__('Users')">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex gap-3">
    @foreach (['name','verified','biodata'] as $field)
        @switch($field)
        @case('name')
            <input type="text" name="name" value="{{ request('name') }}" placeholder="Search Name…"
                class="px-3 py-1 border rounded" />
            @break

        @case('verified')
            <select name="verified" class="px-3 py-1 border rounded">
            <option value="">{{ __('Any Verify') }}</option>
            <option value="1" @selected(request('verified')==='1')>{{ __('Verified') }}</option>
            <option value="0" @selected(request('verified')==='0')>{{ __('Not Verified') }}</option>
            </select>
            @break

        @case('biodata')
            <select name="biodata" class="px-3 py-1 border rounded">
            <option value="">{{ __('Any Biodata') }}</option>
            <option value="1" @selected(request('biodata')==='1')>{{ __('Completed') }}</option>
            <option value="0" @selected(request('biodata')==='0')>{{ __('Not Completed') }}</option>
            </select>
            @break

        {{-- Tambahkan case untuk filter lain --}}
        @endswitch
    @endforeach

    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">{{ __('Filter') }}</button>
    <a href="{{ route('users.index') }}" class="underline text-gray-600 px-4 py-1">{{ __('Reset') }}</a>
    </form>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('Name') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Email Verify') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Role') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Status Biodata') }}</th>
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
                                <span class="text-green-500">{{ __('Download') }}</span>
                            </a>
                        @else
                            <span class="text-red-500">{{ __('Not Completed') }}</span>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        @if ($user->biodata)
                            <a href="{{ route('users.biodata', $user) }}" class="btn btn-sm btn-info text-green-500">{{ __('Lihat Biodata') }}</a>
                        @else
                            <span class="text-red-500">{{ __('Biodata not available') }}</span>
                        @endif
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete Account') }}</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilkan tautan pagination -->
    <div class="mt-4">
        {{ $users->appends(request()->query())->links('pagination::tailwind') }}
    </div>
</x-layouts.app>