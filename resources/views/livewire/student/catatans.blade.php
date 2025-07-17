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
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
    <flux:input wire:model.live="search" placeholder="Cari nama/guru/masalah..." class="!w-auto"/>
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
                        <flux:button href="{{ route('student.catatans.show', $catatan) }}" size="sm" variant="ghost">
                            {{ __('global.view') }}
                        </flux:button>
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
    <div>
        {{ $catatans->links() }}
    </div>
</section>