<x-layouts.app :title="__('Create Biodata')">
    <!-- Tombol kembali -->
    <div class="absolute top-4 left-4 z-10">
        <a href="{{ route('dashboard') }}" class="bg-yellow-400 text-white px-4 py-2 rounded-lg shadow font-semibold inline-flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="w-4 h-4">
            <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd"/>
        </svg>
        Kembali
        </a>
    </div>

    <!-- Form -->
    <!-- Form -->
    <form action="{{ route('biodatas.store') }}" method="POST" enctype="multipart/form-data"
    class="bg-white p-6 sm:p-8 rounded-xl shadow-md w-full max-w-4xl">
    @csrf

    <h2 class="text-center text-xl font-semibold mb-6">Isi Biodata</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <!-- Kolom Kiri -->
    <div class="flex flex-col gap-3">
    <input type="text" name="nisn" placeholder="NISN"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

    <select name="rooms_id"
            class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    <option disabled selected>Kelas</option>
    @foreach ($rooms as $room)
        <option value="{{ $room->id }}">{{ $room->tingkatan_rooms }}</option>
    @endforeach
    </select>

    <input type="text" name="nama" placeholder="Nama"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

    <select name="jurusan_id"
            class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    <option disabled selected>Jurusan</option>
    @foreach ($jurusans as $jurusan)
        <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
    @endforeach
    </select>

    <input type="text" name="telepon" placeholder="Telepon"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

    <select name="agama"
            class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    <option disabled selected>Agama</option>
    <option value="Islam">Islam</option>
    <option value="Kristen">Kristen</option>
    <option value="Hindu">Hindu</option>
    <option value="Budha">Budha</option>
    <option value="Lainnya">Lainnya</option>
    </select>
    </div>

    <!-- Kolom Kanan -->
    <div class="flex flex-col gap-3">
    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

    <select name="jenis_kelamin"
            class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    <option disabled selected>Jenis Kelamin</option>
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
    </select>

    <textarea name="alamat" placeholder="Alamat"
            class="w-full px-4 py-2 rounded-2xl bg-indigo-100 text-sm outline-none resize-none" required></textarea>

    <select name="gol_darah"
            class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    <option disabled selected>Golongan Darah</option>
    <option value="A">A</option>
    <option value="B">B</option>
    <option value="AB">AB</option>
    <option value="O">O</option>
    </select>

    <input type="text" name="status" placeholder="Status"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>

    <input type="file" name="image"
        class="w-full px-4 py-2 rounded-full bg-indigo-100 text-sm outline-none" required>
    </div>
    </div>

    <div class="mt-6 flex justify-end">
    <button type="button" id="simpanBtn"
        class="bg-orange-400 hover:bg-orange-500 text-white text-sm font-semibold px-5 py-2 rounded-full">
    Simpan
    </button>
    </div>
    </form>
</x-layouts.app>

  <script>
    document.getElementById('simpanBtn'x).addEventListener('click', function () {
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin sudah benar biodata ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, simpan!',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33'
      }).then((result) => {
        if (result.isConfirmed) {
          this.closest('form').submit();
        }
      });
    });
  </script>