<section class="w-full">
    <x-page-heading>
        <x-slot:title>Detail Jadwal Konseling</x-slot:title>
    </x-page-heading>

    <div class="grid gap-4">
        <flux:card>
            <flux:card.content>
                <p><strong>Nama Siswa:</strong> {{ $jadwal->pengirim->name }}</p>
                <p><strong>Guru BK:</strong> {{ $jadwal->penerima->name }}</p>
                <p><strong>Lokasi:</strong> {{ $jadwal->lokasi }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</p>
                <p><strong>Topik Dibahas:</strong> {{ $jadwal->topik_dibahas }}</p>
                <p><strong>Status:</strong> 
                    @if($jadwal->status === 'pending')
                        <span class="badge badge-warning">Menunggu</span>
                    @elseif($jadwal->status === 'accepted')
                        <span class="badge badge-success">Diterima</span>
                    @else
                        <span class="badge badge-error">Ditolak</span>
                    @endif
                </p>
                @if($jadwal->status === 'rejected')
                    <p><strong>Alasan Penolakan:</strong> {{ $jadwal->alasan_penolakan }}</p>
                @endif
                @if($jadwal->solusi)
                    <p><strong>Solusi / Hasil Konseling:</strong> {{ $jadwal->solusi }}</p>
                @endif
            </flux:card.content>
        </flux:card>
    </div>

    <div class="mt-6">
        <a href="{{ route('teacher.jadwal-konselings.index') }}" class="btn">Kembali</a>
    </div>
</section>
