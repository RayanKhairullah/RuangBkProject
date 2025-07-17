<section class="w-full">
    <x-page-heading>
        <x-slot:title>Tambah Room</x-slot:title>
    </x-page-heading>

    <x-form wire:submit.prevent="save" class="space-y-6">
        <flux:input wire:model.live="kode_rooms" label="Kode Room" readonly />
        <flux:input wire:model.live="tingkatan_rooms" label="Tingkatan" placeholder="X/XI/XII" minlength="1" maxlength="3" />
        <flux:input wire:model.live="angkatan_rooms" label="Angkatan" placeholder="2025/2026" />

        {{-- Searchable jurusan --}}
        <div class="relative">
            {{-- Bind jurusan_search, tapi kita panggil searchJurusan via keydown --}}
            <flux:input
                wire:model="jurusan_search"
                wire:keydown.debounce.300ms="searchJurusan($event.target.value)"
                label="Cari Jurusan"
                placeholder="Ketik untuk mencari..."
            />

            @if (strlen($jurusan_search) > 0 && count($jurusanResults))
                <ul class="absolute z-10 bg-white border rounded w-full mt-1 max-h-40 overflow-auto">
                    @foreach($jurusanResults as $id => $nama)
                        <li
                            wire:click="selectJurusan({{ $id }})"
                            class="p-2 hover:bg-gray-100 cursor-pointer"
                        >{{ $nama }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Tampilkan error jika belum pilih --}}
        @error('jurusan_id')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror

        <flux:button type="submit" icon="save" variant="primary">
            Simpan
        </flux:button>
    </x-form>
</section>
