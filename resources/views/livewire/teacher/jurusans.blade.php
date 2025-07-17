<section class="w-full">
    <x-page-heading>
        <x-slot:title>Jurusan</x-slot:title>
        <x-slot:subtitle>Manajemen Jurusan</x-slot:subtitle>
        <x-slot:buttons>
            @can('create jurusan')
                <flux:button href="{{ route('teacher.jurusans.create') }}" variant="primary" icon="plus">
                    Tambah Jurusan
                </flux:button>
            @endcan
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
    <flux:input wire:model.live="search" placeholder="Cari jurusan..." class="!w-auto"/>
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
                <x-table.heading>Nama Jurusan</x-table.heading>
                <x-table.heading>{{ __('jurusans.Dibuat Pada') }}</x-table.heading>
                <x-table.heading>{{ __('jurusans.Diubah Pada') }}</x-table.heading> 
                <x-table.heading class="text-right">Aksi</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($jurusans as $jurusan)
                <x-table.row wire:key="jurusan-{{ $jurusan->id }}">
                    <x-table.cell>{{ $jurusan->nama_jurusan }}</x-table.cell>
                    <x-table.cell>{{ $jurusan->created_at->format('Y-m-d H:i') }}</x-table.cell>
                    <x-table.cell>{{ $jurusan->updated_at->format('Y-m-d H:i') }}</x-table.cell> 
                    <x-table.cell class="gap-2 flex justify-end">
                        <flux:button href="{{ route('teacher.jurusans.show', $jurusan) }}" size="sm" variant="ghost">
                            Lihat
                        </flux:button>
                        @can('delete jurusan')
                            <form wire:submit.prevent="deleteJurusan('{{ $jurusan->id }}')" class="inline">
                                <flux:button size="sm" variant="danger" type="submit">
                                    Hapus
                                </flux:button>
                            </form>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>
    <div>
        {{ $jurusans->links() }}
    </div>
</section>