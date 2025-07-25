<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('Main Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard') || request()->routeIs('teacher.dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
                    
                    @if (auth()->user()->role === App\Enums\UserRole::Teacher)
                            {{-- <flux:navlist.item icon="users" :href="route('users.index')" wire:navigate>{{ __('Users') }}</flux:navlist.item> --}}
                            <flux:navlist.item icon="academic-cap" :href="route('rooms.index')" wire:navigate>{{ __('Kelas') }}</flux:navlist.item>
                            <flux:navlist.item icon="puzzle-piece" :href="route('jurusans.index')" wire:navigate>{{ __('Jurusan') }}</flux:navlist.item>

                        <flux:navlist.group :heading="__('Main Feature')" class="grid">
                            <flux:navlist.item icon="chat-bubble-left-right" :href="route('penjadwalan.index')" wire:navigate>{{ __('Konseling') }}</flux:navlist.item>
                            <flux:navlist.item icon="document-text" :href="route('catatans.index')" wire:navigate>{{ __('Catatan Siswa') }}</flux:navlist.item>
                            {{-- <flux:dropdown position="bottom" align="start">
                                <button class="w-full flex items-center justify-between px-4 py-2">
                                    <span class="flex items-center space-x-2">
                                        <flux:icon name="list-bullet" class="w-5 h-5" />
                                        <span>{{ __('Laporan') }}</span>
                                    </span>
                                    <flux:icon name="chevron-down" class="w-4 h-4" />
                                </button>
                            
                                <flux:menu class="w-56">
                                    <flux:menu.item :href="route('surat-panggilan.index')" icon="document-text" wire:navigate>
                                        {{ __('Surat Panggilan') }}
                                    </flux:menu.item>
                                    <flux:menu.item :href="route('surat-panggilan.index')" icon="book-open-text" wire:navigate>
                                        {{ __('Surat X') }}
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown> --}}
                        </flux:navlist.group>

                         <flux:navlist.group :heading="__('Surat Laporan')" class="grid">
                            <flux:navlist.item icon="envelope" :href="route('surat_panggilans.index')" wire:navigate>{{ __('Surat Panggilan Ortu') }}</flux:navlist.item>
                            {{-- <flux:navlist.item icon="list-bullet" :href="route('surat_panggilans.index')" wire:navigate>{{ __('Surat X') }}</flux:navlist.item>
                            <flux:navlist.item icon="list-bullet" :href="route('surat_panggilans.index')" wire:navigate>{{ __('Surat Y') }}</flux:navlist.item> --}}
                         </flux:navlist.group>
                    @endif

                    @if (auth()->user()->role === App\Enums\UserRole::User)
                        <flux:navlist.item icon="identification" :href="route('biodatas.show')" wire:navigate>{{ __('Biodata') }}</flux:navlist.item>
                        <flux:navlist.item icon="chat-bubble-left-right" :href="route('penjadwalan.index')" wire:navigate>{{ __('Konseling') }}</flux:navlist.item>
                        <flux:navlist.item icon="document-text" :href="route('catatans.index')" wire:navigate>{{ __('Catatan Siswa') }}</flux:navlist.item>
                    @endif

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                {{-- <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('Repository') }}
                </flux:navlist.item> --}}

                <flux:navlist.item icon="book-open-text" :href="route('documentation')" wire:navigate>
                    {{ __('Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        @fluxScripts
    </body>
</html>
