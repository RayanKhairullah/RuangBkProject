<section class="w-full">
    <x-page-heading>
        <x-slot:title>Detail Catatan Siswa</x-slot:title>
    </x-page-heading>

    <div class="grid gap-4">
        <flux:card>
            <flux:card.content>
                <p><strong>Nama Siswa:</strong> {{ $catatan->siswa->name }}</p>
                <p><strong>Kelas:</strong> {{ $catatan->room->kode_rooms }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($catatan->tanggal)->format('d M Y') }}</p>
                <p><strong>Masalah Dibahas:</strong> {{ $catatan->masalah_dibahas }}</p>
                <p><strong>Tindak Lanjut:</strong> {{ $catatan->tindak_lanjut }}</p>
                <p><strong>Hasil Akhir:</strong> {{ $catatan->hasil_akhir }}</p>
                <p><strong>Poin:</strong> {{ $catatan->poin }}</p>
            </flux:card.content>
        </flux:card>
    </div>

    <div class="mt-6">
        <a href="{{ route('teacher.catatans.index') }}" class="btn">Kembali</a>
    </div>
</section>
