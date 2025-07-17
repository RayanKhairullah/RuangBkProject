<section class="w-full">
    <x-page-heading>
        <x-slot:title>Tambah Jurusan</x-slot:title>
    </x-page-heading>

    <x-form wire:submit="save" class="space-y-6">
        <flux:input wire:model.live="nama_jurusan" label="Nama Jurusan" placeholder="Nama Jurusan" />

        <flux:button type="submit" icon="save" variant="primary">
            Simpan
        </flux:button>
    </x-form>
</section>