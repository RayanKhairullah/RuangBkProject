<flux:navbar variant="outline" class="space-x-2">
    {{-- Dashboard --}}
    <flux:navbar.item 
        icon="home"
        :href="route('dashboard')"
        :current="request()->routeIs('dashboard')"
        wire:navigate>
        {{ __('Dashboard') }}
    </flux:navbar.item>

    @if(auth()->user()->role === App\Enums\UserRole::Teacher)
        <flux:navbar.item icon="users" :href="route('users.index')" wire:navigate>
            {{ __('Users') }}
        </flux:navbar.item>
        <flux:navbar.item icon="list-bullet" :href="route('rooms.index')" wire:navigate>
            {{ __('Kelas') }}
        </flux:navbar.item>
        <flux:navbar.item icon="list-bullet" :href="route('jurusans.index')" wire:navigate>{{ __('Jurusan') }}</flux:navbar.item>
        <flux:navbar.item icon="list-bullet" :href="route('penjadwalan.index')" wire:navigate>{{ __('Konseling') }}</flux:navbar.item>
        <flux:navbar.item icon="list-bullet" :href="route('catatans.index')" wire:navigate>{{ __('Catatan Prilaku') }}</flux:navbar.item>
        <flux:navbar.item icon="list-bullet" :href="route('surat_panggilans.index')" wire:navigate>{{ __('Surat Panggilan Ortu') }}</flux:navbar.item>
    @endif

    @if(auth()->user()->role === App\Enums\UserRole::User)
        <flux:navbar.item icon="list-bullet" :href="route('biodatas.show')" wire:navigate>
            {{ __('Biodata') }}
        </flux:navbar.item>
        <flux:navlist.item icon="list-bullet" :href="route('penjadwalan.index')" wire:navigate>{{ __('Konseling') }}</flux:navlist.item>
        <flux:navlist.item icon="list-bullet" :href="route('catatans.index')" wire:navigate>{{ __('Catatan Prilaku') }}</flux:navlist.item>
    @endif
</flux:navbar>
