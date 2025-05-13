<x-layouts.app :title="__('Edit Biodata')">
    <form action="{{ route('biodatas.update') }}" method="POST">
        @csrf
        @method('PUT')
    
        <div class="flex flex-col md:flex-row justify-between gap-8">
            <!-- Kolom Kiri -->
            <div class="md:w-2/3 grid grid-cols-3 gap-y-1 text-gray-800 text-sm md:text-base">
                <label class="font-normal" for="nisn">NISN</label><span>:</span>
                <div class="mb-2">
                    <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $biodata->nisn) }}" class="w-full border px-2 py-1 rounded @error('nisn') border-red-500 @enderror" required>
                    @error('nisn')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="jenis_kelamin">Jenis Kelamin</label><span>:</span>
                <div class="mb-2">
                    <select name="jenis_kelamin" id="jenis_kelamin" class="w-full border px-2 py-1 rounded @error('jenis_kelamin') border-red-500 @enderror" required>
                        <option value="Laki-laki" {{ $biodata->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $biodata->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="jurusan_id">Jurusan</label><span>:</span>
                <div class="mb-2">
                    <select name="jurusan_id" id="jurusan_id" class="w-full border px-2 py-1 rounded @error('jurusan_id') border-red-500 @enderror" required>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ $biodata->jurusan_id == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama_jurusan }}
                            </option>
                        @endforeach
                    </select>
                    @error('jurusan_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="rooms_id">Kelas</label><span>:</span>
                <div class="mb-2">
                    <select name="rooms_id" id="rooms_id" class="w-full border px-2 py-1 rounded @error('rooms_id') border-red-500 @enderror" required>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" {{ $biodata->rooms_id == $room->id ? 'selected' : '' }}>
                                {{ $room->tingkatan_rooms }}
                            </option>
                        @endforeach
                    </select>
                    @error('rooms_id')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="telepon">Telepon</label><span>:</span>
                <div class="mb-2">
                    <input type="text" name="telepon" id="telepon" class="w-full border px-2 py-1 rounded @error('telepon') border-red-500 @enderror" value="{{ $biodata->telepon }}" required>
                    @error('telepon')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="agama">Agama</label><span>:</span>
                <div class="mb-2">
                    <select name="agama" id="agama" class="w-full border px-2 py-1 rounded @error('agama') border-red-500 @enderror" required>
                        <option value="Islam" {{ $biodata->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ $biodata->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Hindu" {{ $biodata->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Budha" {{ $biodata->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                        <option value="Lainnya" {{ $biodata->agama == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('agama')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="alamat">Alamat</label><span>:</span>
                <div class="mb-2">
                    <textarea name="alamat" id="alamat" class="w-full border px-2 py-1 rounded @error('alamat') border-red-500 @enderror" required>{{ $biodata->alamat }}</textarea>
                    @error('alamat')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="tanggal_lahir">Tanggal Lahir</label><span>:</span>
                <div class="mb-2">
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="w-full border px-2 py-1 rounded @error('tanggal_lahir') border-red-500 @enderror" value="{{ $biodata->tanggal_lahir }}" required>
                    @error('tanggal_lahir')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="gol_darah">Golongan Darah</label><span>:</span>
                <div class="mb-2">
                    <select name="gol_darah" id="gol_darah" class="w-full border px-2 py-1 rounded @error('gol_darah') border-red-500 @enderror" required>
                        <option value="A" {{ $biodata->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $biodata->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $biodata->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $biodata->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                    @error('gol_darah')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
    
                <label class="font-normal" for="status">Status</label><span>:</span>
                <div class="mb-2">
                    <input type="text" name="status" id="status" class="w-full border px-2 py-1 rounded @error('status') border-red-500 @enderror" value="{{ $biodata->status }}" required>
                    @error('status')<p class="text-red-500 text-sm">{{ $message }}</p>@enderror
                </div>
            </div>
    
            <!-- Kolom Kanan -->
            <div class="md:w-1/3 flex flex-col items-center md:items-end justify-between">
                @if($biodata->image)
                <div class="w-40 h-52 bg-gray-200 flex items-center justify-center rounded shadow">
                    <img src="{{ asset('storage/' . $biodata->image) }}" alt="Foto Siswa"
                         class="max-w-full max-h-full object-contain rounded">
                  </div>
                @else
                    <div class="w-40 h-52 bg-blue-700 text-white flex items-center justify-center rounded text-sm">
                        Foto Siswa
                    </div>
            @endif
            <div class="mb-4">
            <label for="image" class="block text-sm font-medium text-gray-700">Ganti Foto</label>
            <input type="file" name="image" id="image" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-300">
        </div>

<button id="simpanBtn" type="button" class="mt-4 text-sm text-gray-700 hover:underline self-end">Simpan</button>

    </form>
</x-layouts.app>