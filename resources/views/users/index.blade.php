<x-layouts.app :title="__('Users')">
    <div class="mb-4">
        <a href="{{ route('users.create') }}" class="btn btn-primary">{{ __('Create User') }}</a>
    </div>

    <livewire:user-table />
</x-layouts.app>