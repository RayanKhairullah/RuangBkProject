<section class="w-full">
    <x-page-heading>
        <x-slot:title>Catatan Siswa</x-slot:title>
        <x-slot:subtitle>Manajemen Catatan Siswa</x-slot:subtitle>
        <x-slot:buttons>
            @can('create kelas')
                <flux:button href="{{ route('teacher.catatans.create') }}" variant="primary" icon="plus">
                    {{ __('catatans.create_catatan') }}
                </flux:button>
            @endcan
            <flux:button href="{{ route('teacher.catatans.export') }}" variant="primary" icon="save">
                Download Semua Catatan (Excel)
            </flux:button>
        </x-slot:buttons>
    </x-page-heading>

    {{-- Area Filter --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-4">
        {{-- Kolom: Searchable Siswa + tombol export per siswa --}}
        <div class="w-full md:w-1/2 relative">
            <flux:input
                wire:model="siswa_search"
                wire:keydown.debounce.300ms="searchSiswa($event.target.value)"
                label="Cari Siswa"
                placeholder="Ketik nama siswa..."
            />

            @if (strlen($siswa_search) > 0 && count($siswaResults))
                <ul class="absolute z-10 bg-white border rounded w-full mt-1 max-h-40 overflow-auto">
                    @foreach($siswaResults as $id => $nama)
                        <li
                            wire:click="selectSiswa({{ $id }})"
                            class="p-2 hover:bg-gray-100 cursor-pointer"
                        >{{ $nama }}</li>
                    @endforeach
                </ul>
            @endif

            {{-- Tombol download catatan siswa --}}
            <div class="mt-2">
                @if($siswa_id)
                    <flux:button
                        :href="route('teacher.catatans.export.user', $siswa_id)"
                        variant="primary"
                        icon="save"
                    >
                        Download Catatan Siswa
                    </flux:button>
                @else
                    <flux:button
                        :href="'#'"
                        variant="primary"
                        icon="save"
                        :disabled="true"
                    >
                        Download Catatan Siswa
                    </flux:button>
                @endif
            </div>

            {{-- Error validasi --}}
            @error('siswa_id')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Kolom: Search umum + perPage --}}
        <div class="w-full md:w-1/2 flex items-center gap-2">
            <flux:input wire:model.live="search" placeholder="Cari nama/guru/masalah..." class="!w-full"/>
            <flux:select wire:model.live="perPage" class="!w-auto">
                <flux:select.option value="10">{{ __('global.10_per_page') }}</flux:select.option>
                <flux:select.option value="25">{{ __('global.25_per_page') }}</flux:select.option>
                <flux:select.option value="50">{{ __('global.50_per_page') }}</flux:select.option>
                <flux:select.option value="100">{{ __('global.100_per_page') }}</flux:select.option>
            </flux:select>
        </div>
    </div>

    <x-table>
        <x-slot:head>
            <x-table.row>
                <x-table.heading>Nama Siswa</x-table.heading>
                <x-table.heading>Guru</x-table.heading>
                <x-table.heading>Kelas</x-table.heading>
                <x-table.heading>Tanggal</x-table.heading>
                <x-table.heading>Masalah Dibahas</x-table.heading>
                <x-table.heading>Poin</x-table.heading>
                <x-table.heading class="text-right">Aksi</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($catatans as $catatan)
                <x-table.row wire:key="catatan-{{ $catatan->id }}">
                    <x-table.cell>{{ $catatan->siswa->name ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $catatan->guru->name ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $catatan->room->kode_rooms ?? '-' }}</x-table.cell>
                    <x-table.cell>{{ $catatan->tanggal }}</x-table.cell>
                    <x-table.cell>{{ $catatan->masalah_dibahas }}</x-table.cell>
                    <x-table.cell>{{ $catatan->poin }}</x-table.cell>
                    <x-table.cell class="gap-2 flex justify-end">
                        <flux:button href="{{ route('teacher.catatans.export.user', $catatan->siswa->id) }}" size="sm" variant="primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" /></svg>
                            Download Catatan Siswa
                        </flux:button>
                        <flux:button href="{{ route('teacher.catatans.show', $catatan) }}" size="sm" variant="ghost">
                            {{ __('global.view') }}
                        </flux:button>
                        @can('update catatan')
                            <flux:button href="{{ route('teacher.catatans.edit', $catatan) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete catatan')
                            <flux:modal.trigger name="delete-catatan-{{ $catatan->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="delete-catatan-{{ $catatan->id }}" class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('catatans.delete_catatan') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('catatans.you_are_about_to_delete') }}</p>
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
                                    <flux:button type="submit" variant="danger" wire:click.prevent="deleteCatatan('{{ $catatan->id }}')">
                                        {{ __('catatans.delete_catatan') }}
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
        {{ $catatans->links() }}
    </div>
</section>
