<x-layouts.app :title="__('Create Biodata')">
  <form action="{{ route('biodatas.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white dark:bg-gray-900 p-6 sm:p-8 rounded-xl shadow-md w-full max-w-4xl mx-auto my-8">
    @csrf

    <h2 class="text-center text-xl font-semibold mb-6 text-black dark:text-white">Isi Biodata</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Kiri -->
      <div class="flex flex-col gap-3">
        <input name="nama_siswa" placeholder="Nama Siswa"
               value="{{ old('nama_siswa') }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
               required />

        <input name="nisn" placeholder="NISN" type="number" inputmode="numeric" pattern="[0-9]*"
               value="{{ old('nisn') }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
               required />

        <input name="tempat_lahir" placeholder="Tempat Lahir"
               value="{{ old('tempat_lahir') }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
               required />

        <input type="date" name="tanggal_lahir"
               value="{{ old('tanggal_lahir') }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
               required />

        <select name="jenis_kelamin" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
          <option disabled selected>Jenis Kelamin</option>
          <option value="Laki-laki" @selected(old('jenis_kelamin')=='Laki-laki')>Laki-laki</option>
          <option value="Perempuan" @selected(old('jenis_kelamin')=='Perempuan')>Perempuan</option>
        </select>

        <div>
          <label for="kode_rooms" class="text-gray-900 dark:text-gray-300">{{ __('Kode Kelas') }}</label>
          <input name="kode_rooms" id="kode_rooms" type="text"
                value="{{ old('kode_rooms') }}"
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" required>
        </div>

        {{-- Uncomment if needed --}}
        {{-- 
        <select name="jurusan_id" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
          <option disabled selected>Jurusan</option>
          @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->id }}" @selected(old('jurusan_id')==$jurusan->id)>
              {{ $jurusan->nama_jurusan }}
            </option>
          @endforeach
        </select>

        <select name="room_id" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
          <option disabled selected>Kelas</option>
          @foreach ($rooms as $room)
            <option value="{{ $room->id }}" @selected(old('room_id')==$room->id)>
              {{ $room->tingkatan_rooms }}
            </option>
          @endforeach
        </select> 
        --}}
      </div>

      <!-- Kanan -->
      <div class="flex flex-col gap-3">
        <input name="telepon" placeholder="Nomor HP Siswa (08...)" type="number" inputmode="numeric"
              value="{{ old('telepon') }}"
              pattern="08[0-9]{8,12}"
              title="Masukkan nomor HP yang diawali 08 dan terdiri dari 10–14 digit"
              class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
              required />

        <select name="agama" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
          <option disabled selected>Agama</option>
          @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
            <option value="{{ $agama }}" @selected(old('agama')==$agama)>{{ $agama }}</option>
          @endforeach
        </select>

        <textarea name="alamat_ktp" placeholder="Alamat Sesuai KTP"
                  class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none resize-none"
                  required>{{ old('alamat_ktp') }}</textarea>

        <textarea name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                  class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none resize-none">{{ old('alamat_domisili') }}</textarea>

        <select name="gol_darah" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
          <option disabled selected>Golongan Darah</option>
          @foreach (['A','B','AB','O'] as $g)
            <option value="{{ $g }}" @selected(old('gol_darah')==$g)>{{ $g }}</option>
          @endforeach
        </select>

        <input name="status" placeholder="Status/Pelajar"
               value="{{ old('status') }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
               required />

        <input type="file" name="image" accept="image/*"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      </div>
    </div>

    {{-- Seksi tambahan --}}
    <h3 class="mt-6 text-black dark:text-white">Data Pribadi Lainnya</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="cita_cita" placeholder="Cita-cita"
             value="{{ old('cita_cita') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="hobi" placeholder="Hobi"
             value="{{ old('hobi') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="minat_bakat" placeholder="Minat & Bakat"
             value="{{ old('minat_bakat') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
    </div>

    {{-- Riwayat Pendidikan --}}
    <h3 class="mt-6 font-semibold text-black dark:text-white">Riwayat Pendidikan</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="sd" placeholder="SD" value="{{ old('sd') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="smp" placeholder="SMP" value="{{ old('smp') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
    </div>

    {{-- Data Orang Tua --}}
    <h3 class="mt-6 font-semibold text-black dark:text-white">Data Orang Tua</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="nama_ayah" placeholder="Nama Ayah"
             value="{{ old('nama_ayah') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
             value="{{ old('pekerjaan_ayah') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="no_hp_ayah" placeholder="No HP Ayah (08...)"
        value="{{ old('no_hp_ayah') }}"
        pattern="08[0-9]{8,12}"
        title="Masukkan nomor HP ayah yang diawali 08 dan terdiri dari 10–14 digit"
        class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
        required />
      <input name="nama_ibu" placeholder="Nama Ibu" 
             value="{{ old('nama_ibu') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
             value="{{ old('pekerjaan_ibu') }}"
             class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
      <input name="no_hp_ibu" placeholder="No HP Ibu (08...)"
            value="{{ old('no_hp_ibu') }}"
            pattern="08[0-9]{8,12}"
            title="Masukkan nomor HP ibu yang diawali 08 dan terdiri dari 10–14 digit"
            class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
            required />
    </div>

    <div class="mt-6 flex justify-end">
      <button type="submit"
              class="bg-orange-400 hover:bg-orange-500 text-white px-5 py-2 rounded-full">
        Simpan
      </button>
    </div>
  </form>
</x-layouts.app>