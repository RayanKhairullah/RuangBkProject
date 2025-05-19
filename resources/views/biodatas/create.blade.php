<x-layouts.app :title="__('Create Biodata')">
  <div class="min-h-screen bg-gradient-to-br from-yellow-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-900 dark:to-gray-800 flex items-center justify-center py-10 px-2">
    <form action="{{ route('biodatas.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-xl w-full max-w-4xl mx-auto border border-indigo-100 dark:border-indigo-800">
      @csrf

      <h2 class="text-center text-2xl font-bold mb-6 text-orange-500 dark:text-orange-300">Isi Biodata</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kiri -->
        <div class="flex flex-col gap-4">
          <input name="nama_siswa" placeholder="Nama Siswa"
                 value="{{ old('nama_siswa') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <input name="nisn" placeholder="NISN"
                 value="{{ old('nisn') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <input name="tempat_lahir" placeholder="Tempat Lahir"
                 value="{{ old('tempat_lahir') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <input type="date" name="tanggal_lahir"
                 value="{{ old('tanggal_lahir') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <select name="jenis_kelamin" required
                  class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
            <option disabled selected>Jenis Kelamin</option>
            <option value="Laki-laki" @selected(old('jenis_kelamin')=='Laki-laki')>Laki-laki</option>
            <option value="Perempuan" @selected(old('jenis_kelamin')=='Perempuan')>Perempuan</option>
          </select>

          <input name="kode_rooms" id="kode_rooms" type="text"
                placeholder="Kode Kelas"
                value="{{ old('kode_rooms') }}"
                class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                required>
        </div>

        <!-- Kanan -->
        <div class="flex flex-col gap-4">
          <input name="telepon" placeholder="Telepon"
                 value="{{ old('telepon') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <select name="agama" required
                  class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
            <option disabled selected>Agama</option>
            @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
              <option value="{{ $agama }}" @selected(old('agama')==$agama)>{{ $agama }}</option>
            @endforeach
          </select>

          <textarea name="alamat_ktp" placeholder="Alamat Sesuai KTP"
                    class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                    required>{{ old('alamat_ktp') }}</textarea>

          <textarea name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                    class="w-full px-4 py-2 rounded-2xl bg-indigo-50 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">{{ old('alamat_domisili') }}</textarea>

          <select name="gol_darah" required
                  class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
            <option disabled selected>Golongan Darah</option>
            @foreach (['A','B','AB','O'] as $g)
              <option value="{{ $g }}" @selected(old('gol_darah')==$g)>{{ $g }}</option>
            @endforeach
          </select>

          <input name="status" placeholder="Status/Pelajar"
                 value="{{ old('status') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                 required />

          <input type="file" name="image" accept="image/*"
                 class="w-full px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
      </div>

      {{-- Seksi tambahan --}}
      <h3 class="mt-8 text-lg font-semibold text-orange-500 dark:text-orange-300">Data Pribadi Lainnya</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <input name="cita_cita" placeholder="Cita-cita"
               value="{{ old('cita_cita') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="hobi" placeholder="Hobi"
               value="{{ old('hobi') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="minat_bakat" placeholder="Minat & Bakat"
               value="{{ old('minat_bakat') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
      </div>

      {{-- Riwayat Pendidikan --}}
      <h3 class="mt-8 text-lg font-semibold text-orange-500 dark:text-orange-300">Riwayat Pendidikan</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <input name="sd" placeholder="SD" value="{{ old('sd') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="smp" placeholder="SMP" value="{{ old('smp') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
      </div>

      {{-- Data Orang Tua --}}
      <h3 class="mt-8 text-lg font-semibold text-orange-500 dark:text-orange-300">Data Orang Tua</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
        <input name="nama_ayah" placeholder="Nama Ayah"
               value="{{ old('nama_ayah') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
               value="{{ old('pekerjaan_ayah') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="no_hp_ayah" placeholder="No HP Ayah"
               value="{{ old('no_hp_ayah') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="nama_ibu" placeholder="Nama Ibu"
               value="{{ old('nama_ibu') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
               value="{{ old('pekerjaan_ibu') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        <input name="no_hp_ibu" placeholder="No HP Ibu"
               value="{{ old('no_hp_ibu') }}"
               class="px-4 py-2 rounded-full bg-indigo-50 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
      </div>

      <div class="mt-8 flex justify-end">
        <button type="submit"
                class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
          Simpan
        </button>
      </div>
    </form>
  </div>
</x-layouts.app>