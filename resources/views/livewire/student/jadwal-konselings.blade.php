<section class="w-full">
    <x-page-heading>
        <x-slot:title>Jadwal Konseling</x-slot:title>
        <x-slot:subtitle>Manajemen Jadwal Konseling</x-slot:subtitle>
        <x-slot:buttons>
            @can('create konselings')
                <flux:button href="{{ route('student.jadwal-konselings.create') }}" variant="primary" icon="plus">
                    {{ __('jadwal-konselings.create_jadwal') }}
                </flux:button>
            @endcan
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
        <flux:spacer/>
    </div>
    <div class="flex items-center justify-between w-full mb-6 gap-2">
    <flux:input wire:model.live="search" placeholder="Cari nama/topik..." class="!w-auto"/>
        <flux:spacer/>
        <flux:select wire:model.live="perPage" class="!w-auto">
            <flux:select.option value="5">{{ __('global.5_per_page') }}</flux:select.option>
            <flux:select.option value="10">{{ __('global.10_per_page') }}</flux:select.option>
            <flux:select.option value="25">{{ __('global.25_per_page') }}</flux:select.option>
            <flux:select.option value="50">{{ __('global.50_per_page') }}</flux:select.option>
        </flux:select>
    </div>

    <x-table>
        <x-slot:head>
            <x-table.row>
                <x-table.heading>Pengirim</x-table.heading>
                <x-table.heading>Penerima</x-table.heading>
                <x-table.heading>Topik</x-table.heading>
                <x-table.heading>Lokasi</x-table.heading>
                <x-table.heading>Tanggal</x-table.heading>
                <x-table.heading>Status</x-table.heading>
                <x-table.heading class="text-right">Aksi</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($jadwalKonselings as $jadwal)
                <x-table.row wire:key="jadwal-{{ $jadwal->id }}">
                    <x-table.cell>{{ $jadwal->pengirim->name ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $jadwal->penerima->name ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $jadwal->topik_dibahas }}</x-table.cell>
                    <x-table.cell>{{ $jadwal->lokasi }}</x-table.cell>
                    <x-table.cell>{{ $jadwal->tanggal }}</x-table.cell>
                    <x-table.cell>
                        <span class="capitalize">{{ $jadwal->status }}</span>
                        @if($jadwal->status === 'rejected' && $jadwal->alasan_penolakan)
                            <br><small class="text-red-500">({{ $jadwal->alasan_penolakan }})</small>
                        @endif
                    </x-table.cell>
                    <x-table.cell class="gap-2 flex justify-end">
                        <flux:button href="{{ route('student.jadwal-konselings.show', $jadwal) }}" size="sm" variant="ghost">
                            {{ __('global.view') }}
                        </flux:button>
                        <button wire:click="sendEmailToTeacher({{ $jadwal->id }})" wire:loading.attr="disabled" wire:target="sendEmailToTeacher({{ $jadwal->id }})">
                            <span wire:loading.remove wire:target="sendEmailToTeacher({{ $jadwal->id }})">Kirim ke Email Guru</span>
                            <span wire:loading wire:target="sendEmailToTeacher({{ $jadwal->id }})">Mengirim...</span>
                        </button>
                        @can('update konselings')
                            <flux:button href="{{ route('student.jadwal-konselings.edit', $jadwal) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete konselings')
                            <flux:modal.trigger name="delete-jadwal-{{ $jadwal->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="delete-jadwal-{{ $jadwal->id }}" class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('jadwal-konselings.delete_jadwal') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('jadwal-konselings.you_are_about_to_delete') }}</p>
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
                                    <flux:button type="submit" variant="danger" wire:click.prevent="deletejadwal('{{ $jadwal->id }}')">
                                        {{ __('jadwal-konselings.delete_jadwal') }}
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
        {{ $jadwalKonselings->links() }}
    </div>
</section>