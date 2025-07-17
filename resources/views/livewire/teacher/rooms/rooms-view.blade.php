<section class="w-full">
    <x-page-heading>
        <x-slot:title>Detail Room: {{ $room->kode_rooms }}</x-slot:title>
    </x-page-heading>

    <div class="grid gap-4">
        <flux:card>
            <flux:card.content>
                <p><strong>Kode Room:</strong> {{ $room->kode_rooms }}</p>
                <p><strong>Tingkatan:</strong> {{ $room->tingkatan_rooms }}</p>
                <p><strong>Angkatan:</strong> {{ $room->angkatan_rooms }}</p>
                <p><strong>Jurusan:</strong> {{ $room->jurusan->nama_jurusan ?? '-' }}</p>
                <x-table>
                    <x-slot:head>
                        <x-table.row>
                            <x-table.heading>Nama</x-table.heading>
                            <x-table.heading>Email</x-table.heading>
                            <x-table.heading>Status Biodata</x-table.heading>
                            <x-table.heading>Aksi</x-table.heading>
                        </x-table.row>
                    </x-slot:head>
                    <x-slot:body>
                    @foreach($room->users as $user)
                        @php
                            $biodata = $user->biodata;
                            $isComplete = $biodata && $biodata->nisn && $biodata->alamat_ktp && $biodata->nama_ayah; // bisa kamu sesuaikan field2 wajib
                        @endphp
                        <x-table.row>
                            <x-table.cell>{{ $user->name ?? '-' }}</x-table.cell>
                            <x-table.cell>{{ $user->email ?? '-' }}</x-table.cell>
                            <x-table.cell>
                                @if($isComplete)
                                    <button type="button" onclick="showPdfPreview('{{ route('teacher.biodata.pdf-preview', $biodata->id) }}')" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold mb-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                        </svg>
                                        Preview PDF
                                    </button>
                                    <a href="{{ route('teacher.biodata.export.pdf', $biodata->id) }}" 
                                       class="inline-flex items-center text-green-600 hover:text-green-800 font-semibold mt-1">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        Unduh PDF
                                    </a>
                                @else
                                    <span class="text-red-600 font-semibold">Data Belum Lengkap</span>
                                @endif
                            </x-table.cell>
                            <x-table.cell>
                                @if($biodata)
                                    <a href="{{ route('teacher.rooms.biodatas.view', ['user_id' => $user->id]) }}" class="text-green-600 underline ml-2">Lihat Biodata</a>
                                @else
                                    <span class="text-red-600 font-semibold">Not Complete</span>
                                @endif
                            </x-table.cell>
                        </x-table.row>
                    @endforeach
                    </x-slot:body>
                </x-table>
            </flux:card.content>
        </flux:card>
    </div>

    <div id="pdf-preview-area" class="w-full mt-8" style="display:none;">
        <div class="font-semibold mb-2">Preview Biodata PDF:</div>
        <iframe id="pdf-preview-iframe" src="" width="100%" height="400" style="border:1px solid #ccc; min-width:260px; max-width:100vw;"></iframe>
    </div>
    <div class="mt-6">
        <a href="{{ route('teacher.rooms.index') }}" class="btn">Kembali</a>
    </div>
<script>
function showPdfPreview(pdfUrl) {
    var area = document.getElementById('pdf-preview-area');
    var iframe = document.getElementById('pdf-preview-iframe');
    iframe.src = pdfUrl;
    area.style.display = 'block';
    // Optional: scroll to preview area for mobile
    area.scrollIntoView({behavior:'smooth'});
}
</script>
</section>