<x-layouts.app :title="__('Edit Biodata')">
    <form action="{{ route('biodatas.update') }}" {{-- Route update tidak memerlukan ID di sini karena sudah di handle di controller --}}
        method="POST"
        enctype="multipart/form-data"
        class="bg-white dark:bg-gray-900 p-6 sm:p-8 rounded-xl shadow-md w-full max-w-4xl mx-auto my-8">
        @csrf
        @method('PUT') {{-- Penting untuk metode update --}}

        <h2 class="text-center text-xl font-semibold mb-6 text-black dark:text-white">Edit Biodata</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="flex flex-col gap-3">
                <input name="nama_siswa" placeholder="Nama Siswa"
                       value="{{ old('nama_siswa', $biodata->nama_siswa) }}"
                       class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                       required />
                @error('nama_siswa') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


                <input name="nisn" placeholder="NISN" type="number" inputmode="numeric" pattern="[0-9]*"
                       value="{{ old('nisn', $biodata->nisn) }}"
                       class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                       required />
                @error('nisn') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <input name="tempat_lahir" placeholder="Tempat Lahir"
                       value="{{ old('tempat_lahir', $biodata->tempat_lahir) }}"
                       class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                       required />
                @error('tempat_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

              <input type="date" name="tanggal_lahir"
                     value="{{ old('tanggal_lahir', $biodata->tanggal_lahir ? $biodata->tanggal_lahir->format('Y-m-d') : '') }}"
                     class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                     required />
                @error('tanggal_lahir') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <select name="jenis_kelamin" required
                        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
                    <option disabled selected>Jenis Kelamin</option>
                    <option value="Laki-laki" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Laki-laki')>Laki-laki</option>
                    <option value="Perempuan" @selected(old('jenis_kelamin', $biodata->jenis_kelamin)=='Perempuan')>Perempuan</option>
                </select>
                @error('jenis_kelamin') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <div>
                    <label for="kode_rooms" class="text-gray-900 dark:text-gray-300">{{ __('Kode Kelas') }}</label>
                    {{-- Untuk edit, kode_rooms diambil dari relasi user --}}
                    <input name="kode_rooms" id="kode_rooms" type="text"
                           value="{{ old('kode_rooms', $biodata->user->kode_rooms ?? '') }}"
                           class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" required>
                </div>
                @error('kode_rooms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                {{-- Uncomment if needed --}}
                {{--
                <select name="jurusan_id" required
                        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
                    <option disabled selected>Jurusan</option>
                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" @selected(old('jurusan_id', $biodata->jurusan_id)==$jurusan->id)>
                            {{ $jurusan->nama_jurusan }}
                        </option>
                    @endforeach
                </select>

                <select name="room_id" required
                        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
                    <option disabled selected>Kelas</option>
                    @foreach ($rooms as $room)
                        <option value="{{ $room->id }}" @selected(old('room_id', $biodata->room_id)==$room->id)>
                            {{ $room->tingkatan_rooms }}
                        </option>
                    @endforeach
                </select>
                --}}
            </div>

            <div class="flex flex-col gap-3">
              <input name="telepon" placeholder="Nomor HP Siswa (diawali 08, 10-14 digit)" type="text" inputmode="numeric"
                    value="{{ old('telepon', $biodata->telepon ?? '08') }}" {{-- Menggunakan ?? '08' untuk default jika kosong --}}
                    pattern="^08[0-9]{8,12}$"
                    title="Nomor HP harus diawali '08' dan terdiri dari 10-14 digit angka."
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                    required />
              @error('telepon') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror


                <select name="agama" required
                        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
                    <option disabled selected>Agama</option>
                    @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
                        <option value="{{ $agama }}" @selected(old('agama', $biodata->agama)==$agama)>{{ $agama }}</option>
                    @endforeach
                </select>
                @error('agama') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea name="alamat_ktp" placeholder="Alamat Sesuai KTP"
                          class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none resize-none"
                          required>{{ old('alamat_ktp', $biodata->alamat_ktp) }}</textarea>
                @error('alamat_ktp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <textarea name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                          class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none resize-none">{{ old('alamat_domisili', $biodata->alamat_domisili) }}</textarea>
                @error('alamat_domisili') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <select name="gol_darah" required
                        class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none">
                    <option disabled selected>Golongan Darah</option>
                    @foreach (['A','B','AB','O'] as $g)
                        <option value="{{ $g }}" @selected(old('gol_darah', $biodata->gol_darah)==$g)>{{ $g }}</option>
                    @endforeach
                </select>
                @error('gol_darah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                <input name="status" placeholder="Status/Pelajar"
                       value="{{ old('status', $biodata->status) }}"
                       class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                       required />
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                {{-- Bagian untuk menampilkan gambar yang sudah ada dan input upload --}}
                <div class="flex items-center gap-4">
                    @if ($biodata->image)
                     <div class="w-20 aspect-square">
                            <img class="w-full h-full object-cover rounded-full" src="{{ Storage::url($biodata->image) }}" alt="Foto Biodata" />
                     </div>
                        <button type="button" onclick="document.getElementById('image_upload').value = ''; document.getElementById('current_image_preview').style.display='none';"
                                class="text-red-500 hover:text-red-700 text-sm font-medium">Hapus Foto Saat Ini</button>
                    @endif
                    <input type="file" name="image" id="image_upload" accept="image/*"
                           class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
                </div>
                @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Seksi tambahan --}}
        <h3 class="mt-6 text-black dark:text-white">Data Pribadi Lainnya</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
            <input name="cita_cita" placeholder="Cita-cita"
                   value="{{ old('cita_cita', $biodata->cita_cita) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('cita_cita') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="hobi" placeholder="Hobi"
                   value="{{ old('hobi', $biodata->hobi) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('hobi') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="minat_bakat" placeholder="Minat & Bakat"
                   value="{{ old('minat_bakat', $biodata->minat_bakat) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('minat_bakat') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Riwayat Pendidikan --}}
        <h3 class="mt-6 font-semibold text-black dark:text-white">Riwayat Pendidikan</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
            <input name="sd" placeholder="SD" value="{{ old('sd', $biodata->sd) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('sd') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="smp" placeholder="SMP" value="{{ old('smp', $biodata->smp) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('smp') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Data Orang Tua --}}
        <h3 class="mt-6 font-semibold text-black dark:text-white">Data Orang Tua</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-2">
            <input name="nama_ayah" placeholder="Nama Ayah"
                   value="{{ old('nama_ayah', $biodata->nama_ayah) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('nama_ayah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="pekerjaan_ayah" placeholder="Pekerjaan Ayah"
                   value="{{ old('pekerjaan_ayah', $biodata->pekerjaan_ayah) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('pekerjaan_ayah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="no_hp_ayah" placeholder="No HP Ayah (diawali 08, 10-14 digit)"
                  type="text" inputmode="numeric"
                  value="{{ old('no_hp_ayah', $biodata->no_hp_ayah ?? '08') }}"
                  pattern="^08[0-9]{8,12}$"
                  title="Nomor HP Ayah harus diawali '08' dan terdiri dari 10-14 digit angka."
                  class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                  required />
            @error('no_hp_ayah') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="nama_ibu" placeholder="Nama Ibu"
                   value="{{ old('nama_ibu', $biodata->nama_ibu) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('nama_ibu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="pekerjaan_ibu" placeholder="Pekerjaan Ibu"
                   value="{{ old('pekerjaan_ibu', $biodata->pekerjaan_ibu) }}"
                   class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none" />
            @error('pekerjaan_ibu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <input name="no_hp_ibu" placeholder="No HP Ibu (diawali 08, 10-14 digit)"
                  type="text" inputmode="numeric"
                  value="{{ old('no_hp_ibu', $biodata->no_hp_ibu ?? '08') }}"
                  pattern="^08[0-9]{8,12}$"
                  title="Nomor HP Ibu harus diawali '08' dan terdiri dari 10-14 digit angka."
                  class="px-4 py-2 rounded-full bg-indigo-100 dark:bg-indigo-900 text-sm dark:text-indigo-200 outline-none"
                  required />
            @error('no_hp_ibu') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit"
                    class="bg-orange-400 hover:bg-orange-500 text-white px-5 py-2 rounded-full">
                Perbarui
            </button>
        </div>
    </form>
</x-layouts.app>