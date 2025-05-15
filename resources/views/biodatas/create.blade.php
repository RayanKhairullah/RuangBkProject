<x-layouts.app :title="__('Isi Biodata')">
    <div class="mb-6">
        <a href="{{ url()->previous() }}" class="bg-yellow-400 text-white px-4 py-2 rounded-lg shadow font-semibold inline-flex items-center gap-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-4 h-4" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd"/>
            </svg>
            Kembali
        </a>
    </div>

    <form action="{{ route('biodatas.store') }}" method="POST" enctype="multipart/form-data" id="biodataForm">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Kolom Kiri -->
            <div>
                <div class="mb-4">
                    <label for="nisn">NISN</label>
                    <input type="text" name="nisn" id="nisn" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>

                <div class="mb-4">
                    <label for="rooms_id">Kelas</label>
                    <select name="rooms_id" id="rooms_id" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                        <option disabled selected>Pilih Kelas</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->tingkatan_rooms }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>

                <div class="mb-4">
                    <label for="jurusan_id">Jurusan</label>
                    <select name="jurusan_id" id="jurusan_id" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                        <option disabled selected>Pilih Jurusan</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="telepon">Telepon</label>
                    <input type="text" name="telepon" id="telepon" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>

                <div class="mb-4">
                    <label for="agama">Agama</label>
                    <select name="agama" id="agama" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                        <option disabled selected>Pilih Agama</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen">Kristen</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Budha">Budha</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div>
                <div class="mb-4">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>

                <div class="mb-4">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-inputw-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                        <option disabled selected>Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-input resize-none w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required></textarea>
                </div>

                <div class="mb-4">
                    <label for="gol_darah">Golongan Darah</label>
                    <select name="gol_darah" id="gol_darah" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                        <option disabled selected>Pilih Golongan Darah</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="status">Status</label>
                    <input type="text" name="status" id="status" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>

                <div class="mb-4">
                    <label for="image">Foto</label>
                    <input type="file" name="image" id="image" class="form-input w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-orange-400 bg-white text-gray-900 dark:bg-gray-600 dark:text-black dark:border-gray-600" required>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="button" id="simpanBtn" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2 rounded-full">
                Simpan
            </button>
        </div>
    </form>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('simpanBtn').addEventListener('click', function () {
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
                    document.getElementById('biodataForm').submit();
                }
            });
        });
    </script>
    
</x-layouts.app>
