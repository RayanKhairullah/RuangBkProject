<x-layouts.app :title="__('Edit Biodata')">
  <form action="{{ route('biodatas.update') }}"
        method="POST"
        enctype="multipart/form-data"
        class="bg-white p-6 sm:p-8 rounded-xl shadow-md w-full max-w-4xl mx-auto my-8">
    @csrf
    @method('PUT')

    <h2 class="text-center text-xl font-semibold mb-6 text-black">Edit Biodata</h2>

    <h3 class="mb-2 font-semibold text-black">Data Wajib</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <!-- Kiri -->
      <div class="flex flex-col gap-3">
        <input name="nama_siswa" placeholder="Nama Siswa"
               value="{{ old('nama_siswa', $biodata->nama_siswa) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required />

        <input name="nisn" placeholder="NISN"
               value="{{ old('nisn', $biodata->nisn) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required />

        <input name="tempat_lahir" placeholder="Tempat Lahir"
               value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required />

        <input type="date" name="tanggal_lahir"
               value="{{ old('tanggal_lahir', $biodata->tanggal_lahir) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required />

        <select name="jenis_kelamin" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none">
          <option disabled>Jenis Kelamin</option>
          <option value="Laki-laki" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Laki-laki')>
            Laki-laki
          </option>
          <option value="Perempuan" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Perempuan')>
            Perempuan
          </option>
        </select>

          <input name="kode_rooms" id="kode_rooms"
                value="{{ old('kode_rooms', $biodata->room->kode_rooms) }}"
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

        {{-- <select name="jurusan_id" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none">
          <option disabled>Jurusan</option>
          @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->id }}"
                    @selected(old('jurusan_id', $biodata->jurusan_id)==$jurusan->id)>
              {{ $jurusan->nama_jurusan }}
            </option>
          @endforeach
        </select>

        <select name="room_id" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none">
          <option disabled>Kelas</option>
          @foreach ($rooms as $room)
            <option value="{{ $room->id }}"
                    @selected(old('room_id', $biodata->room_id)==$room->id)>
              {{ $room->tingkatan_rooms }}
            </option>
          @endforeach
        </select> --}}
      </div>

      <!-- Kanan -->
      <div class="flex flex-col gap-3">
        <input name="telepon" placeholder="Telepon"
               value="{{ old('telepon', $biodata->telepon) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required />

        <select name="agama" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none">
          <option disabled>Agama</option>
          @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
            <option value="{{ $agama }}"
                    @selected(old('agama', $biodata->agama)==$agama)>{{ $agama }}</option>
          @endforeach
        </select>

        <textarea name="alamat_ktp" placeholder="Alamat KTP"
                  class="w-full px-4 py-2 rounded-2xl bg-indigo-100 text-sm outline-none resize-none"
                  required>{{ old('alamat_ktp', $biodata->alamat_ktp) }}</textarea>

        <textarea name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                  class="w-full px-4 py-2 rounded-2xl bg-indigo-100 text-sm outline-none resize-none">
          {{ old('alamat_domisili', $biodata->alamat_domisili) }}
        </textarea>

        <select name="gol_darah" required
                class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none">
          <option disabled>Golongan Darah</option>
          @foreach (['A','B','AB','O'] as $g)
            <option value="{{ $g }}"
                    @selected(old('gol_darah', $biodata->gol_darah)==$g)>{{ $g }}</option>
          @endforeach
        </select>

        <input name="status" placeholder="Status"
               value="{{ old('status', $biodata->status) }}"
               class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none"
               required placeholder="Pelajar" />
      </div>
    </div>

        {{-- Seksi tambahan --}}
    <h3 class="mt-6 font-semibold text-black">Data Pribadi Lainnya</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="cita_cita" placeholder="Cita-cita"
             value="{{ old('cita_cita') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="hobi" placeholder="Hobi"
             value="{{ old('hobi') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="minat_bakat" placeholder="Minat & Bakat"
             value="{{ old('minat_bakat') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
    </div>

    {{-- Riwayat Pendidikan --}}
    <h3 class="mt-6 font-semibold text-black">Riwayat Pendidikan</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="sd" placeholder="SD" value="{{ old('sd') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="smp" placeholder="SMP" value="{{ old('smp') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
    </div>

    {{-- Data Orang Tua --}}
    <h3 class="mt-6 font-semibold text-black">Data Orang Tua</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
      <input name="nama_ayah" placeholder="Nama Ayah"
             value="{{ old('nama_ayah') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
             value="{{ old('pekerjaan_ayah') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="no_hp_ayah" placeholder="No HP Ayah"
             value="{{ old('no_hp_ayah') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="nama_ibu" placeholder="Nama Ibu"
             value="{{ old('nama_ibu') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
             value="{{ old('pekerjaan_ibu') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
      <input name="no_hp_ibu" placeholder="No HP Ibu"
             value="{{ old('no_hp_ibu') }}"
             class="px-4 py-2 rounded-full bg-indigo-100" />
    </div>

    <div>
      <h3 class="mt-3 font-semibold text-black">Foto Siswa</h3>
      <label class="block mb-1">Foto Siswa</label>
        @if($biodata->image)
          <img src="{{ asset('storage/'.$biodata->image) }}"
            class="max-w-full max-h-40 object-contain">
        @endif
        <input type="file" name="image" accept="image/*"
          class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" />
    </div>

    <div class="mt-6 flex justify-end space-x-2">
      <button type="submit"
              class="bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-full">
        Update
      </button>
      <a href="{{ route('biodatas.show') }}"
         class="bg-gray-300 hover:bg-gray-400 text-black px-5 py-2 rounded-full">
        Batal
      </a>
    </div>
  </form>
</x-layouts.app>