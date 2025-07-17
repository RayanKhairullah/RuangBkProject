<section class="w-full">
    <x-page-heading>
        <x-slot:title>Detail Jurusan: {{ $jurusan->nama_jurusan }}</x-slot:title>
    </x-page-heading>

    <div class="grid gap-4">
        <flux:card>
            <flux:card.content>
                <p><strong>Nama Jurusan:</strong> {{ $jurusan->nama_jurusan }}</p>
                <p><strong>Jumlah Room:</strong> {{ $jurusan->rooms()->count() }}</p>
            </flux:card.content>
        </flux:card>
    </div>

    <div class="mt-6">
        <a href="{{ route('teacher.jurusans.index') }}" class="btn">Kembali</a>
    </div>
</section>