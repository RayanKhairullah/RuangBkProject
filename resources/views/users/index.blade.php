<x-layouts.app :title="__('Users')">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-6 bg-white dark:bg-gray-800 rounded-xl shadow p-4 flex flex-wrap gap-4 items-end border border-indigo-100 dark:border-indigo-800">
        @foreach (['name','verified','biodata'] as $field)
            @switch($field)
            @case('name')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('Nama') }}</label>
                    <input type="text" name="name" value="{{ request('name') }}" placeholder="Cari Nama…"
                        class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
                </div>
                @break

            @case('verified')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('Verifikasi Email') }}</label>
                    <select name="verified" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                        <option value="">{{ __('Semua') }}</option>
                        <option value="1" @selected(request('verified')==='1')>{{ __('Verified') }}</option>
                        <option value="0" @selected(request('verified')==='0')>{{ __('Not Verified') }}</option>
                    </select>
                </div>
                @break

            @case('biodata')
                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-300 mb-1">{{ __('Status Biodata') }}</label>
                    <select name="biodata" class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
                        <option value="">{{ __('Semua') }}</option>
                        <option value="1" @selected(request('biodata')==='1')>{{ __('Lengkap') }}</option>
                        <option value="0" @selected(request('biodata')==='0')>{{ __('Belum Lengkap') }}</option>
                    </select>
                </div>
                @break
            @endswitch
        @endforeach

        <div class="flex gap-2 mt-2 md:mt-0">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-full font-semibold shadow transition">
                {{ __('Filter') }}
            </button>
            <a href="{{ route('users.index') }}"
               class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 px-5 py-2 rounded-full font-semibold shadow transition">
                {{ __('Reset') }}
            </a>
        </div>
    </form>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-2xl shadow border border-indigo-100 dark:border-indigo-800">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-indigo-50 dark:bg-gray-700 text-indigo-700 dark:text-indigo-200">
                    <th class="border-b px-4 py-3 text-left">{{ __('Name') }}</th>
                    <th class="border-b px-4 py-3 text-left">{{ __('Email') }}</th>
                    <th class="border-b px-4 py-3 text-left">{{ __('Email Verify') }}</th>
                    <th class="border-b px-4 py-3 text-left">{{ __('Role') }}</th>
                    <th class="border-b px-4 py-3 text-left">{{ __('Status Biodata') }}</th>
                    <th class="border-b px-4 py-3 text-left">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-orange-50 dark:hover:bg-gray-900 transition">
                    <td class="border-b px-4 py-2">{{ $user->name }}</td>
                    <td class="border-b px-4 py-2">{{ $user->email }}</td>
                    <td class="border-b px-4 py-2">
                        @if ($user->email_verified_at)
                            <span class="text-green-600 dark:text-green-400 font-semibold">{{ __('Verified') }}</span>
                        @else
                            <span class="text-red-500 dark:text-red-400 font-semibold">{{ __('Not Verified') }}</span>
                        @endif
                    </td>
                    <td class="border-b px-4 py-2">{{ ucfirst($user->role->value) }}</td>
                    <td class="border-b px-4 py-2">
                        @if ($user->biodata)
                            <a href="{{ route('users.downloadBiodata', $user) }}"
                               class="inline-block bg-green-100 dark:bg-green-900 hover:bg-green-200 dark:hover:bg-green-800 text-green-700 dark:text-green-200 px-3 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                {{ __('Download') }}
                            </a>
                        @else
                            <span class="text-red-500 dark:text-red-400 font-semibold">{{ __('Not Completed') }}</span>
                        @endif
                    </td>
                    <td class="border-b px-4 py-2 space-x-1">
                        @if ($user->biodata)
                            <a href="{{ route('users.biodata', $user) }}"
                               class="inline-block bg-blue-100 dark:bg-blue-900 hover:bg-blue-200 dark:hover:bg-blue-800 text-blue-700 dark:text-blue-200 px-3 py-1 rounded-full text-xs font-semibold shadow transition mb-1">
                                {{ __('Lihat Biodata') }}
                            </a>
                        @else
                            <span class="text-red-500 dark:text-red-400 text-xs">{{ __('Biodata not available') }}</span>
                        @endif
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow transition"
                                onclick="return confirm('{{ __('Are you sure?') }}')">
                                {{ __('Delete Account') }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Tampilkan tautan pagination -->
    <div class="mt-6 flex justify-center">
        {{ $users->appends(request()->query())->links('pagination::tailwind') }}
    </div>
</x-layouts.app>