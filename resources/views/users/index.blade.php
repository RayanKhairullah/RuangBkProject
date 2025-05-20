<x-layouts.app :title="__('Users')">
    <!-- Filter Form -->
    <form method="GET" action="{{ route('users.index') }}" class="mb-6 flex flex-wrap gap-3 items-center">
        @foreach (['name','verified','biodata'] as $field)
            @switch($field)
                @case('name')
                    <input
                        type="text"
                        name="name"
                        value="{{ request('name') }}"
                        placeholder="{{ __('Search Name…') }}"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-400"
                    />
                    @break

                @case('verified')
                    <select
                        name="verified"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-400"
                    >
                        <option value="">{{ __('Any Verify') }}</option>
                        <option value="1" @selected(request('verified')==='1')>{{ __('Verified') }}</option>
                        <option value="0" @selected(request('verified')==='0')>{{ __('Not Verified') }}</option>
                    </select>
                    @break

                @case('biodata')
                    <select
                        name="biodata"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500
                               dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 dark:focus:ring-blue-400"
                    >
                        <option value="">{{ __('Any Biodata') }}</option>
                        <option value="1" @selected(request('biodata')==='1')>{{ __('Completed') }}</option>
                        <option value="0" @selected(request('biodata')==='0')>{{ __('Not Completed') }}</option>
                    </select>
                    @break
            @endswitch
        @endforeach

        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded-md hover:bg-blue-700 transition
                       dark:bg-blue-500 dark:hover:bg-blue-600"
        >
            {{ __('Filter') }}
        </button>

        <!-- Tombol Reset -->
        <a href="{{ route('users.index') }}"
           class="inline-block px-4 py-2 rounded-md border border-gray-400
                  bg-transparent text-gray-700 hover:bg-gray-200 hover:text-gray-900
                  dark:border-gray-600 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white
                  transition"
        >
            {{ __('Reset') }}
        </a>
    </form>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md dark:bg-gray-800">
        <table class="min-w-full border-collapse border border-gray-300 dark:border-gray-600">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Name') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Email') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Email Verify') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Role') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Status Biodata') }}</th>
                    <th class="border border-gray-300 px-4 py-2 text-center text-sm font-semibold text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm dark:text-gray-200">
                            @if ($user->email_verified_at)
                                <span class="text-green-600 font-semibold dark:text-green-400">{{ __('Verified') }}</span>
                            @else
                                <span class="text-red-600 font-semibold dark:text-red-400">{{ __('Not Verified') }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-gray-800 text-sm dark:text-gray-200">{{ ucfirst($user->role->value) }}</td>
                        <td class="border border-gray-300 px-4 py-3 text-sm dark:text-gray-200">
                            @if ($user->biodata)
                                <a href="{{ route('users.downloadBiodata', $user) }}"
                                   class="inline-block px-3 py-1 text-green-700 bg-green-100 rounded hover:bg-green-200 transition
                                          dark:bg-green-900 dark:text-green-300 dark:hover:bg-green-800"
                                >
                                    {{ __('Download') }}
                                </a>
                            @else
                                <span class="text-red-600 font-semibold dark:text-red-400">{{ __('Not Completed') }}</span>
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-3 text-center space-x-2 text-sm dark:text-gray-200">
                            @if ($user->biodata)
                                <!-- Tombol Lihat Biodata -->
                                <a href="{{ route('users.biodata', $user) }}"
                                   class="inline-block px-3 py-1 rounded-md
                                          bg-blue-100 text-blue-700 hover:bg-blue-200
                                          dark:bg-blue-900 dark:text-blue-300 dark:hover:bg-blue-800
                                          transition"
                                >
                                    {{ __('Lihat Biodata') }}
                                </a>
                            @else
                                <span class="text-red-600 dark:text-red-400">{{ __('Biodata not available') }}</span>
                            @endif

                            <!-- Tombol Delete Account -->
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="px-3 py-1 rounded-md
                                           bg-red-600 text-white hover:bg-red-700
                                           dark:bg-red-700 dark:hover:bg-red-600
                                           transition"
                                    onclick="return confirm('{{ __('Are you sure?') }}')"
                                >
                                    {{ __('Delete Account') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500 dark:text-gray-400">{{ __('No users found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $users->appends(request()->query())->links('pagination::tailwind') }}
    </div>
</x-layouts.app>
