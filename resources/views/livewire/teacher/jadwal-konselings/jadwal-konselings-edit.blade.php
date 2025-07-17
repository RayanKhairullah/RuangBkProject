<section class="w-full">
    <x-page-heading>
        <x-slot:title>Edit Jadwal Konseling</x-slot:title>
    </x-page-heading>

    <x-form wire:submit="update" class="space-y-6">
        <flux:input wire:model.live="lokasi" label="Lokasi Konseling" placeholder="Contoh: Ruang BK" />
        <flux:input type="date" wire:model.live="tanggal" label="Tanggal Konseling" />
        <flux:textarea wire:model.live="topik_dibahas" label="Topik Dibahas" placeholder="Tulis topik atau permasalahan yang dibahas..." />
        <flux:textarea wire:model.live="solusi" label="Solusi / Hasil Konseling" placeholder="Opsional, isi setelah konseling dilakukan" />

        <flux:select wire:model.live="status" label="Status Konseling">
            <option value="pending">Pending</option>
            <option value="accepted">Diterima</option>
            <option value="rejected">Ditolak</option>
        </flux:select>

        @if($status === 'rejected')
            <flux:textarea wire:model.live="alasan_penolakan" label="Alasan Penolakan" placeholder="Wajib diisi jika ditolak" />
        @endif

        <div class="flex gap-2">
            <flux:button type="submit" icon="save" variant="primary">Simpan Perubahan</flux:button>
            <a href="{{ route('teacher.jadwal-konselings.index') }}" class="btn">Batal</a>
        </div>
    </x-form>
</section>
