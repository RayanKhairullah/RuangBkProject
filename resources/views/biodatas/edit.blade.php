<x-layouts.app :title="__('Edit Biodata')">
  <form action="{{ route('biodatas.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white dark:bg-gray-800 p-6 sm:p-8 rounded-2xl shadow-lg w-full max-w-4xl mx-auto my-10 border border-indigo-100 dark:border-indigo-800">
    @csrf
    @method('PUT')

    <h2 class="text-center text-2xl font-bold mb-8 text-orange-500 dark:text-orange-300">Edit Biodata Siswa</h2>

    <div class="mb-8">
      <h3 class="mb-3 font-semibold text-black dark:text-white text-lg border-b border-indigo-100 dark:border-indigo-800 pb-2">Data Wajib</h3>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kiri -->
        <div class="flex flex-col gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Siswa</label>
            <input name="nama_siswa" placeholder="Nama Siswa"
                   value="{{ old('nama_siswa', $biodata->nama_siswa) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">NISN</label>
            <input name="nisn" placeholder="NISN"
                   value="{{ old('nisn', $biodata->nisn) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tempat Lahir</label>
            <input name="tempat_lahir" placeholder="Tempat Lahir"
                   value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir"
                   value="{{ old('tanggal_lahir', $biodata->tanggal_lahir) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis Kelamin</label>
            <select name="jenis_kelamin" required
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
              <option disabled>Jenis Kelamin</option>
              <option value="Laki-laki" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Laki-laki')>
                Laki-laki
              </option>
              <option value="Perempuan" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Perempuan')>
                Perempuan
              </option>
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Kode Kelas</label>
            <input name="kode_rooms" id="kode_rooms"
                  value="{{ old('kode_rooms', $biodata->room->kode_rooms) }}"
                  class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                  required>
          </div>
        </div>
        <!-- Kanan -->
        <div class="flex flex-col gap-4">
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Telepon</label>
            <input name="telepon" placeholder="Telepon"
                   value="{{ old('telepon', $biodata->telepon) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Agama</label>
            <select name="agama" required
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
              <option disabled>Agama</option>
              @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
                <option value="{{ $agama }}"
                        @selected(old('agama', $biodata->agama)==$agama)>{{ $agama }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Alamat KTP</label>
            <textarea name="alamat_ktp" placeholder="Alamat KTP"
                      class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                      required>{{ old('alamat_ktp', $biodata->alamat_ktp) }}</textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Alamat Domisili (jika beda)</label>
            <textarea name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                      class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">{{ old('alamat_domisili', $biodata->alamat_domisili) }}</textarea>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Golongan Darah</label>
            <select name="gol_darah" required
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
              <option disabled>Golongan Darah</option>
              @foreach (['A','B','AB','O'] as $g)
                <option value="{{ $g }}"
                        @selected(old('gol_darah', $biodata->gol_darah)==$g)>{{ $g }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Status</label>
            <input name="status" placeholder="Status"
                   value="{{ old('status', $biodata->status) }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
        </div>
      </div>
    </div>

    <div class="border-t border-indigo-100 dark:border-indigo-800 pt-6 mt-6">
      <h3 class="font-semibold text-black dark:text-white text-lg mb-3">Data Pribadi Lainnya</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Cita-cita</label>
          <input name="cita_cita" placeholder="Cita-cita"
                 value="{{ old('cita_cita', $biodata->cita_cita ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Hobi</label>
          <input name="hobi" placeholder="Hobi"
                 value="{{ old('hobi', $biodata->hobi ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Minat & Bakat</label>
          <input name="minat_bakat" placeholder="Minat & Bakat"
                 value="{{ old('minat_bakat', $biodata->minat_bakat ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
      </div>
    </div>

    <div class="border-t border-indigo-100 dark:border-indigo-800 pt-6 mt-6">
      <h3 class="font-semibold text-black dark:text-white text-lg mb-3">Riwayat Pendidikan</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">SD</label>
          <input name="sd" placeholder="SD" value="{{ old('sd', $biodata->sd ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">SMP</label>
          <input name="smp" placeholder="SMP" value="{{ old('smp', $biodata->smp ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
      </div>
    </div>

    <div class="border-t border-indigo-100 dark:border-indigo-800 pt-6 mt-6">
      <h3 class="font-semibold text-black dark:text-white text-lg mb-3">Data Orang Tua</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Ayah</label>
          <input name="nama_ayah" placeholder="Nama Ayah"
                 value="{{ old('nama_ayah', $biodata->nama_ayah ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Pekerjaan Ayah</label>
          <input name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
                 value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">No HP Ayah</label>
          <input name="no_hp_ayah" placeholder="No HP Ayah"
                 value="{{ old('no_hp_ayah', $biodata->no_hp_ayah ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Ibu</label>
          <input name="nama_ibu" placeholder="Nama Ibu"
                 value="{{ old('nama_ibu', $biodata->nama_ibu ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Pekerjaan Ibu</label>
          <input name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
                 value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">No HP Ibu</label>
          <input name="no_hp_ibu" placeholder="No HP Ibu"
                 value="{{ old('no_hp_ibu', $biodata->no_hp_ibu ?? '') }}"
                 class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
        </div>
      </div>
    </div>

    <div class="border-t border-indigo-100 dark:border-indigo-800 pt-6 mt-6">
      <h3 class="font-semibold text-black dark:text-white text-lg mb-3">Foto Siswa</h3>
      <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Foto Siswa</label>
      @if($biodata->image)
        <img src="{{ asset('storage/'.$biodata->image) }}"
          class="max-w-full max-h-40 object-contain mb-3 rounded-lg border shadow" alt="Foto Siswa">
      @endif
      <input type="file" name="image" accept="image/*"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100" />
    </div>

    <div class="mt-8 flex justify-end space-x-3">
      <button type="submit"
              class="bg-green-500 hover:bg-green-600 text-white px-8 py-2 rounded-full font-semibold shadow transition">
        Update
      </button>
      <a href="{{ route('biodatas.show') }}"
         class="bg-gray-300 dark:bg-gray-700 hover:bg-gray-400 dark:hover:bg-gray-600 text-black dark:text-gray-100 px-8 py-2 rounded-full font-semibold shadow transition">
        Batal
      </a>
    </div>
  </form>
</x-layouts.app>