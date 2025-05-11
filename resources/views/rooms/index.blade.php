<x-layouts.app :title="__('Rooms')">
    <div class="mb-4">
        <a href="{{ route('rooms.create') }}" class="btn btn-primary">{{ __('Create Room') }}</a>
    </div>

    @livewire('room-filter')
</x-layouts.app>