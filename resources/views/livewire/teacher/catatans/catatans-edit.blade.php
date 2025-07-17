<section class="w-full">
    <x-page-heading>
        <x-slot:title>Edit Catatan Siswa</x-slot:title>
    </x-page-heading>

    <x-form wire:submit="update" class="space-y-6">
        <div>
            <flux:input wire:model.live.debounce.300ms="searchSiswa" placeholder="Cari nama siswa..." label="Cari Siswa" />
            @if(!empty($searchSiswa))
                <ul class="bg-white border rounded shadow max-h-40 overflow-y-auto mt-1">
                    @foreach($filteredSiswas as $siswa)
                        <li class="px-2 py-1 hover:bg-blue-100 cursor-pointer" wire:click="$set('user_id', {{ $siswa->id }})">
                            {{ $siswa->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
            @if($user_id)
                <div class="mt-1 text-green-600 text-sm">
                    Siswa terpilih: {{ optional($filteredSiswas->firstWhere('id', $user_id))->name }}
                </div>
            @endif
        </div>

        {{-- Autocomplete Cari Kelas --}}
        <div>
            <flux:input wire:model.live.debounce.300ms="searchKelas" placeholder="Cari kelas..." label="Cari Kelas" />
            @if(!empty($searchKelas))
                <ul class="bg-white border rounded shadow max-h-40 overflow-y-auto mt-1">
                    @foreach($filteredRooms as $room)
                        <li class="px-2 py-1 hover:bg-blue-100 cursor-pointer" wire:click="$set('room_id', {{ $room->id }})">
                            {{ $room->kode_rooms }}
                        </li>
                    @endforeach
                </ul>
            @endif
            @if($room_id)
                <div class="mt-1 text-green-600 text-sm">
                    Kelas terpilih: {{ optional($filteredRooms->firstWhere('id', $room_id))->kode_rooms }}
                </div>
            @endif
        </div>

        <flux:input type="date" wire:model.live="tanggal" label="Tanggal Catatan" />

        <flux:textarea wire:model.live="masalah_dibahas" label="Masalah Dibahas" />
        <flux:textarea wire:model.live="tindak_lanjut" label="Tindak Lanjut" />
        <flux:textarea wire:model.live="hasil_akhir" label="Hasil Akhir" />

        <flux:input type="number" wire:model.live="poin" label="Poin" />

        <div class="flex gap-2">
            <flux:button type="submit" icon="save" variant="primary">Update</flux:button>
            <a href="{{ route('teacher.catatans.index') }}" class="btn">Batal</a>
        </div>
    </x-form>
</section>
