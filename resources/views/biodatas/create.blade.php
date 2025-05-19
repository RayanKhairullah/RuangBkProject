<x-layouts.app :title="__('Create Biodata')">
  <div class="max-w-4xl mx-auto my-8">
    <div class="text-center mb-8">
      <h1 class="text-3xl font-bold text-orange-500 dark:text-orange-300 mb-2">Formulir Biodata Siswa</h1>
      <p class="text-gray-600 dark:text-gray-300">Silakan isi data diri Anda dengan lengkap dan benar.</p>
    </div>
    <form action="{{ route('biodatas.store') }}"
          method="POST"
          enctype="multipart/form-data"
          class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg w-full border border-indigo-100 dark:border-indigo-800">
      @csrf

      <h2 class="text-xl font-semibold mb-6 text-black dark:text-white border-b border-indigo-100 dark:border-indigo-800 pb-2">Data Siswa</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Kiri -->
        <div class="flex flex-col gap-4">
          <div>
            <label for="nama_siswa" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Nama Siswa</label>
            <input id="nama_siswa" name="nama_siswa" placeholder="Nama Siswa"
                   value="{{ old('nama_siswa') }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label for="nisn" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">NISN</label>
            <input id="nisn" name="nisn" placeholder="NISN"
                   value="{{ old('nisn') }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tempat Lahir</label>
            <input id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir"
                   value="{{ old('tempat_lahir') }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                   value="{{ old('tanggal_lahir') }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
              <option disabled selected>Jenis Kelamin</option>
              <option value="Laki-laki" @selected(old('jenis_kelamin')=='Laki-laki')>Laki-laki</option>
              <option value="Perempuan" @selected(old('jenis_kelamin')=='Perempuan')>Perempuan</option>
            </select>
          </div>
          <div>
            <label for="kode_rooms" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Kode Kelas</label>
            <input name="kode_rooms" id="kode_rooms" type="text"
                  value="{{ old('kode_rooms') }}"
                  class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                  required>
          </div>
        </div>
        <!-- Kanan -->
        <div class="flex flex-col gap-4">
          <div>
            <label for="telepon" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Telepon</label>
            <input id="telepon" name="telepon" placeholder="Telepon"
                   value="{{ old('telepon') }}"
                   class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                   required />
          </div>
          <div>
            <label for="agama" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Agama</label>
            <select id="agama" name="agama" required
                    class="w-full px-4 py-2 rounded-full bg-indigo-100 dark:bg-gray-700 text-sm outline-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">
              <option disabled selected>Agama</option>
              @foreach (['Islam','Kristen','Hindu','Budha','Lainnya'] as $agama)
                <option value="{{ $agama }}" @selected(old('agama')==$agama)>{{ $agama }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label for="alamat_ktp" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Alamat Sesuai KTP</label>
            <textarea id="alamat_ktp" name="alamat_ktp" placeholder="Alamat Sesuai KTP"
                      class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100"
                      required>{{ old('alamat_ktp') }}</textarea>
          </div>
          <div>
            <label for="alamat_domisili" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-1">Alamat Domisili (jika beda)</label>
            <textarea id="alamat_domisili" name="alamat_domisili" placeholder="Alamat Domisili (jika beda)"
                      class="w-full px-4 py-2 rounded-2xl bg-indigo-100 dark:bg-gray-700 text-sm outline-none resize-none focus:ring-2 focus:ring-orange-300 transition text-gray-900 dark:text-gray-100">{{ old('alamat_domisili') }}</textarea>
          </div>
          <div>
            <label for="gol_darah" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb