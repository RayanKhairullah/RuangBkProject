<section class="w-full">
    <x-page-heading>
        <x-slot:title>Detail Surat Panggilan</x-slot:title>
    </x-page-heading>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <flux:field label="Nomor Surat">
            {{ $surat->nomor_surat }}
        </flux:field>

        <flux:field label="Nama Siswa">
            {{ $surat->biodata->user->name ?? '-' }}
        </flux:field>

        <flux:field label="Kelas">
            {{ $surat->room->kode_rooms ?? '-' }}
        </flux:field>

        <flux:field label="Tanggal & Waktu Konseling">
            {{ \Carbon\Carbon::parse($surat->tanggal_waktu)->translatedFormat('l, d F Y H:i') }}
        </flux:field>

        <flux:field label="Tempat">
            {{ $surat->tempat }}
        </flux:field>

        <flux:field label="Tujuan Konseling">
            {{ $surat->tujuan }}
        </flux:field>
    </div>

    <div class="mt-6 flex flex-col md:flex-row gap-2 items-start md:items-center">
        <a href="{{ route('teacher.surat-panggilans.export.pdf', $surat->id) }}" target="_blank" class="btn btn-primary flex items-center gap-1">
            <i class="fa fa-download"></i> Download PDF
        </a>
        <a href="{{ route('teacher.surat-panggilans.pdf-preview', $surat->id) }}" target="_blank" class="btn btn-secondary flex items-center gap-1">
            <i class="fa fa-eye"></i> Preview PDF
        </a>
        <a href="{{ route('teacher.surat-panggilans.index') }}" class="btn">
            Kembali
        </a>
    </div>

    {{-- Preview PDF Embed --}}
    <div class="mt-8">
        <iframe src="{{ route('teacher.surat-panggilans.pdf-preview', $surat->id) }}" width="100%" height="600" style="border:1px solid #888;"></iframe>
    </div>
</section>
