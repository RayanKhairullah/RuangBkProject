<section class="w-full">
    <x-page-heading>
        <x-slot:title>Edit Surat Panggilan</x-slot:title>
    </x-page-heading>

    <x-form wire:submit="update" class="space-y-6">
        <flux:input wire:model.live="nomor_surat" label="Nomor Surat" placeholder="Contoh: 123/SP/BK/2025" />
        
        <div>
            <flux:input wire:model.live.debounce.300ms="searchSiswa" placeholder="Cari nama siswa..." label="Cari Siswa" />
            @if(!empty($searchSiswa))
                <ul class="bg-white border rounded shadow max-h-40 overflow-y-auto mt-1">
                    @foreach($filteredBiodatas as $data)
                        <li class="px-2 py-1 hover:bg-blue-100 cursor-pointer" wire:click="$set('biodata_id', {{ $data->id }})">
                            {{ $data->user->name }}
                        </li>
                    @endforeach
                </ul>
            @endif
            @if($biodata_id)
                <div class="mt-1 text-green-600 text-sm">
                    Siswa terpilih: {{ optional($filteredBiodatas->firstWhere('id', $biodata_id))->user->name }}
                </div>
            @endif
        </div>

        <div>
            <flux:input wire:model.live.debounce.300ms="searchRoom" placeholder="Cari kelas..." label="Cari Kelas" />
            @if(!empty($searchRoom))
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

        <flux:input type="datetime-local" wire:model.live="tanggal_waktu" label="Tanggal & Waktu Konseling" />
        <flux:input wire:model.live="tempat" label="Tempat" placeholder="Contoh: Ruang BK" />
        <flux:textarea wire:model.live="tujuan" label="Tujuan" placeholder="Tulis tujuan pemanggilan..." />

        <div class="flex gap-2">
            <flux:button type="submit" icon="save" variant="primary">Simpan Perubahan</flux:button>
            <a href="{{ route('teacher.surat-panggilans.index') }}" class="btn">Batal</a>
        </div>
    </x-form>
</section>
