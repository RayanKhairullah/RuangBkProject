<section class="w-full">
    <x-page-heading>
        <x-slot:title>Surat Panggilan</x-slot:title>
        <x-slot:subtitle>Manajemen Surat Panggilan</x-slot:subtitle>
    <x-slot:buttons>
        @can('create surat panggilan')
            <flux:button href="{{ route('teacher.surat-panggilans.create') }}" variant="primary" icon="plus">
                Buat Surat
            </flux:button>
        @endcan
    </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
        <flux:input wire:model.live="search" placeholder="Cari nomor surat/nama siswa..." class="!w-auto"/>
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
                <x-table.heading>Nomor Surat</x-table.heading>
                <x-table.heading>Nama Siswa</x-table.heading>
                <x-table.heading>Kelas</x-table.heading>
                <x-table.heading>Tanggal & Waktu</x-table.heading>
                <x-table.heading>Tempat</x-table.heading>
                <x-table.heading>Tujuan</x-table.heading>
                <x-table.heading class="text-right">Aksi</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($suratPanggilans as $surat)
                <x-table.row wire:key="surat-{{ $surat->id }}">
                    <x-table.cell>{{ $surat->nomor_surat }}</x-table.cell>
                    <x-table.cell>{{ $surat->biodata->user->name ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $surat->room->kode_rooms ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $surat->tanggal_waktu }}</x-table.cell>
                    <x-table.cell>{{ $surat->tempat }}</x-table.cell>
                    <x-table.cell>{{ $surat->tujuan }}</x-table.cell>
                    <x-table.cell class="gap-2 flex justify-end">
                        <flux:button href="{{ route('teacher.surat-panggilans.show', $surat) }}" size="sm" variant="ghost">
                            {{ __('global.view') }}
                        </flux:button>
                        @can('update surat panggilan')
                            <flux:button href="{{ route('teacher.surat-panggilans.edit', $surat) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete surat panggilan')
                            <flux:modal.trigger name="delete-surat-{{ $surat->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="delete-surat-panggilans-{{ $surat->id }}" class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('surat-panggilans.delete_surat') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('surat-panggilans.you_are_about_to_delete') }}</p>
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
                                    <flux:button type="submit" variant="danger" wire:click.prevent="deletesurat('{{ $surat->id }}')">
                                        {{ __('surats.delete_surat') }}
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
        {{ $suratPanggilans->links() }}
    </div>
</section>