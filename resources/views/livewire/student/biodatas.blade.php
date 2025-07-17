<section class="w-full max-w-4xl mx-auto">
    <x-page-heading>
        <x-slot:title>Biodata Saya</x-slot:title>
        <x-slot:subtitle>Isi biodata untuk keperluan Bimbingan Konseling</x-slot:subtitle>
    </x-page-heading>

    <form wire:submit.prevent="save" class="space-y-6">
        {{-- Info Pribadi --}}
        <section>
            <x-slot:title>Informasi Pribadi</x-slot:title>
            <x-slot:description>Lengkapi data diri kamu dengan benar.</x-slot:description>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="NISN" wire:model.defer="form.nisn" required id="nisn" maxlength="10" inputmode="numeric" pattern="[0-9]{10}" />
                <flux:select label="Jenis Kelamin" wire:model.defer="form.jenis_kelamin" required>
                    <option value="">Pilih</option>
                    <option value="Laki-laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </flux:select>

                <flux:input label="Kode Kelas" wire:model.defer="form.kode_kelas" required id="kode_kelas" maxlength="4" style="text-transform:uppercase" />
                <flux:input label="Tempat Lahir" wire:model.defer="form.tempat_lahir" />
                <flux:input label="Tanggal Lahir" wire:model.defer="form.tanggal_lahir" type="date" />
                <flux:input label="Telepon" wire:model.defer="form.telepon" id="telepon" maxlength="13" inputmode="numeric" />
                <flux:input label="Agama" wire:model.defer="form.agama" />
                <flux:input label="Golongan Darah" wire:model.defer="form.gol_darah" />
            </div>

            <flux:textarea label="Alamat KTP" wire:model.defer="form.alamat_ktp" />
            <flux:textarea label="Alamat Domisili" wire:model.defer="form.alamat_domisili" />
        </section>

        {{-- Minat dan Keluarga --}}
        <section>
            <x-slot:title>Minat dan Keluarga</x-slot:title>
            <x-slot:description>Ceritakan tentang keluarga dan minatmu.</x-slot:description>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Cita-Cita" wire:model.defer="form.cita_cita" />
                <flux:input label="Hobi" wire:model.defer="form.hobi" />
                <flux:input label="Minat & Bakat" wire:model.defer="form.minat_bakat" />
                <flux:input label="Nama Ayah" wire:model.defer="form.nama_ayah" />
                <flux:input label="Pekerjaan Ayah" wire:model.defer="form.pekerjaan_ayah" />
                <flux:input label="No HP Ayah" wire:model.defer="form.no_hp_ayah" id="no_hp_ayah" maxlength="13" inputmode="numeric" />
                <flux:input label="Nama Ibu" wire:model.defer="form.nama_ibu" />
                <flux:input label="Pekerjaan Ibu" wire:model.defer="form.pekerjaan_ibu" />
                <flux:input label="No HP Ibu" wire:model.defer="form.no_hp_ibu" id="no_hp_ibu" maxlength="13" inputmode="numeric" />
            </div>
        </section>

        {{-- Upload Foto --}}
        <section>
            <x-slot:title>Foto Profil</x-slot:title>
            <x-slot:description>Unggah foto profil terbaru.</x-slot:description>

            <flux:file-upload label="Gambar" wire:model="form.image" />
            @if ($form['image'])
                <img src="{{ $form['image']->temporaryUrl() }}" class="h-32 mt-2 rounded-md" />
            @elseif($imagePreview)
                <img src="{{ asset('storage/' . $imagePreview) }}" class="h-32 mt-2 rounded-md" />
            @endif
        </section>

        <flux:button type="submit" icon="save" variant="primary">
            Simpan Biodata
        </flux:button>
    </form>

    <script>
        // NISN hanya angka, 10 digit
        document.getElementById('nisn').addEventListener('input', function(e) {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        });

        // Kode Kelas hanya huruf dan angka, 4 karakter, auto uppercase
        document.getElementById('kode_kelas').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-Z0-9]/g, '').toUpperCase().slice(0, 4);
        });

        // Helper untuk nomor telepon
        function formatHp(input) {
            let val = input.value.replace(/\D/g, '');
            if(val.startsWith('62')) val = val;
            else if(val.startsWith('0')) val = '62' + val.slice(1);
            else if(!val.startsWith('62')) val = '62' + val;
            if(val.length > 13) val = val.slice(0, 13);
            input.value = '+'.concat(val);
        }
        
        document.getElementById('telepon').addEventListener('input', function(e) {
            formatHp(this);
        });
        document.getElementById('no_hp_ayah').addEventListener('input', function(e) {
            formatHp(this);
        });
        document.getElementById('no_hp_ibu').addEventListener('input', function(e) {
            formatHp(this);
        });
    </script>
</section>
