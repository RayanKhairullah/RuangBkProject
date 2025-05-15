<x-layouts.app :title="__('Edit Biodata')">
    <div class="absolute top-4 left-4 z-20">
        <a href="{{ route('biodatas.show') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg shadow font-semibold inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                <path fill-rule="evenodd" d="M12.5 9.75A2.75 2.75 0 0 0 9.75 7H4.56l2.22 2.22a.75.75 0 1 1-1.06 1.06l-3.5-3.5a.75.75 0 0 1 0-1.06l3.5-3.5a.75.75 0 0 1 1.06 1.06L4.56 5.5h5.19a4.25 4.25 0 0 1 0 8.5h-1a.75.75 0 0 1 0-1.5h1a2.75 2.75 0 0 0 2.75-2.75Z" clip-rule="evenodd" />
            </svg>          
        </a>
    </div>

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="bg-gray-800 rounded-xl shadow-lg max-w-6xl w-full p-8 mx-auto">
            <h1 class="text-center text-2xl md:text-3xl font-light mb-8 text-gray-200">Edit Biodata</h1>
            
            <form id="biodataForm" action="{{ route('biodatas.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div class="flex flex-col md:flex-row justify-between gap-8">
                    <!-- Kolom Kiri -->
                    <div class="md:w-2/3 grid grid-cols-3 gap-y-1 text-gray-300 text-sm md:text-base">
                        <div class="mb-2">
                            <label class="font-normal" for="nisn">NISN:</label>
                            <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $biodata->nisn) }}" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('nisn') border-red-500 @enderror" required>
                            @error('nisn')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="jenis_kelamin">Jenis Kelamin:</label>
                        <div class="mb-2">
                            <select name="jenis_kelamin" id="jenis_kelamin" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('jenis_kelamin') border-red-500 @enderror" required>
                                <option value="Laki-laki" {{ $biodata->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ $biodata->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="jurusan_id">Jurusan:</label>
                        <div class="mb-2">
                            <select name="jurusan_id" id="jurusan_id" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('jurusan_id') border-red-500 @enderror" required>
                                @foreach ($jurusans as $jurusan)
                                    <option value="{{ $jurusan->id }}" {{ $biodata->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                        {{ $jurusan->nama_jurusan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jurusan_id')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="rooms_id">Kelas:</label>
                        <div class="mb-2">
                            <select name="rooms_id" id="rooms_id" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('rooms_id') border-red-500 @enderror" required>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ $biodata->rooms_id == $room->id ? 'selected' : '' }}>
                                        {{ $room->tingkatan_rooms }}
                                    </option>
                                @endforeach
                            </select>
                            @error('rooms_id')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="telepon">Telepon:</label>
                        <div class="mb-2">
                            <input type="text" name="telepon" id="telepon" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('telepon') border-red-500 @enderror" value="{{ $biodata->telepon }}" required>
                            @error('telepon')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="agama">Agama:</label>
                        <div class="mb-2">
                            <select name="agama" id="agama" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('agama') border-red-500 @enderror" required>
                                <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Hindu" {{ $biodata->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Budha" {{ $biodata->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                                <option value="Lainnya" {{ $biodata->agama == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                            @error('agama')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="alamat">Alamat:</label>
                        <div class="mb-2">
                            <textarea name="alamat" id="alamat" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('alamat') border-red-500 @enderror" required>{{ $biodata->alamat }}</textarea>
                            @error('alamat')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="tanggal_lahir">Tanggal Lahir:</label>
                        <div class="mb-2">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('tanggal_lahir') border-red-500 @enderror" value="{{ $biodata->tanggal_lahir }}" required>
                            @error('tanggal_lahir')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="gol_darah">Golongan Darah:</label>
                        <div class="mb-2">
                            <select name="gol_darah" id="gol_darah" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('gol_darah') border-red-500 @enderror" required>
                                <option value="A" {{ $biodata->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                                <option value="B" {{ $biodata->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                                <option value="AB" {{ $biodata->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                                <option value="O" {{ $biodata->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                            @error('gol_darah')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    
                        <label class="font-normal" for="status">Status:</label>
                        <div class="mb-2">
                            <input type="text" name="status" id="status" class="w-full bg-gray-700 border border-gray-600 px-2 py-1 rounded text-white @error('status') border-red-500 @enderror" value="{{ $biodata->status }}" required>
                            @error('status')<p class="text-red-400 text-sm">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    
                    <!-- Kolom Kanan -->
                    <div class="md:w-1/3 flex flex-col items-center md:items-end justify-between">
                        @if($biodata->image)
                        <div class="w-40 h-52 bg-gray-700 flex items-center justify-center rounded shadow">
                            <img src="{{ asset('storage/' . $biodata->image) }}" alt="Foto Siswa"
                                class="max-w-full max-h-full object-contain rounded">
                        </div>
                        @else
                            <div class="w-40 h-52 bg-blue-700 text-white flex items-center justify-center rounded text-sm">
                                Foto Siswa
                            </div>
                        @endif
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-300">Ganti Foto</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full bg-gray-700 border border-gray-600 rounded-md shadow-sm text-gray-300 focus:ring focus:ring-indigo-400 focus:border-indigo-500">
                        </div>
                        
                        <button id="simpanBtn" type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow-sm transition-colors duration-200 mt-4">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('biodataForm');
            const simpanBtn = document.getElementById('simpanBtn');
            
            if (form && simpanBtn) {
                // Mencegah form submit langsung ketika tombol diklik
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Tampilkan konfirmasi SweetAlert
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menyimpan perubahan biodata ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, simpan!',
                        cancelButtonText: 'Batal',
                        confirmButtonColor: '#4f46e5',
                        cancelButtonColor: '#d33',
                        background: '#1f2937',
                        color: '#e5e7eb'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Submit form jika dikonfirmasi
                            form.submit();
                        }
                    });
                });
            }
        });
    </script>
    @endpush
</x-layouts.app>