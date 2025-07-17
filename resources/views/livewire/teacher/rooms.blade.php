<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('rooms.title') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('rooms.title_description') }}
        </x-slot:subtitle>
        <x-slot:buttons>
            @can('create kelas')
                <flux:button href="{{ route('teacher.rooms.create') }}" variant="primary" icon="plus">
                    {{ __('rooms.create_room') }}
                </flux:button>
            @endcan
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
        <flux:input wire:model.live="search" placeholder="{{ __('global.search_here') }}" class="!w-auto"/>
        <flux:spacer/>
        <flux:select wire:model.live="perPage" class="!w-auto">
            <flux:select.option value="10">{{ __('global.10_per_page') }}</flux:select.option>
            <flux:select.option value="25">{{ __('global.25_per_page') }}</flux:select.option>
            <flux:select.option value="50">{{ __('global.50_per_page') }}</flux:select.option>
            <flux:select.option value="100">{{ __('global.100_per_page') }}</flux:select.option>
        </flux:select>
    </div>

    <x-table>
        <x-slot:head>
            <x-table.row>
                <x-table.heading>{{ __('rooms.kode') }}</x-table.heading>
                <x-table.heading>{{ __('rooms.tingkatan') }}</x-table.heading>
                <x-table.heading>{{ __('rooms.angkatan') }}</x-table.heading>
                <x-table.heading>{{ __('rooms.jurusan') }}</x-table.heading>
                <x-table.heading>{{ __('rooms.Dibuat Pada') }}</x-table.heading>
                <x-table.heading>{{ __('rooms.Diubah Pada') }}</x-table.heading> 
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($rooms as $room)
                <x-table.row wire:key="room-{{ $room->id }}">
                    <x-table.cell>{{ $room->kode_rooms }}</x-table.cell>
                    <x-table.cell>{{ $room->tingkatan_rooms }}</x-table.cell>
                    <x-table.cell>{{ $room->angkatan_rooms }}</x-table.cell>
                    <x-table.cell>{{ $room->jurusan->nama_jurusan ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $room->created_at->format('Y-m-d H:i') }}</x-table.cell>
                    <x-table.cell>{{ $room->updated_at->format('Y-m-d H:i') }}</x-table.cell> 
                    <x-table.cell class="gap-2 flex justify-end">
                        <flux:button href="{{ route('teacher.rooms.show', $room) }}" size="sm" variant="ghost">
                            {{ __('global.view') }}
                        </flux:button>
                        @can('update kelas')
                            <flux:button href="{{ route('teacher.rooms.edit', $room) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete kelas')
                            <flux:modal.trigger name="delete-room-{{ $room->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="delete-room-{{ $room->id }}" class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('rooms.delete_room') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('rooms.you_are_about_to_delete') }}</p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">
                                            {{ __('global.cancel') }}
                                        </flux:button>
                                    </flux:modal.close>
                                    <flux:spacer/>
                                    <flux:button type="submit" variant="danger" wire:click.prevent="deleteRoom('{{ $room->id }}')">
                                        {{ __('rooms.delete_room') }}
                                    </flux:button>
                                </div>
                            </flux:modal>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>

    <div>
        {{ $rooms->links() }}
    </div>
</section>
