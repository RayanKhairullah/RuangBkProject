<x-layouts.app :title="__('Biodata')">
    <!-- Corner Backgrounds -->
  <div class="absolute top-0 left-0 w-24 h-24 bg-yellow-400 rounded-br-2xl z-0"></div>
  <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-400 rounded-bl-2xl z-0"></div>
  <div class="absolute bottom-0 left-0 w-24 h-24 bg-indigo-400 rounded-tr-2xl z-0"></div>
  <div class="absolute bottom-0 right-0 w-24 h-24 bg-yellow-400 rounded-tl-2xl z-0"></div>

  <!-- Tombol Home -->
  <div class="absolute top-4 left-4 z-20">
    <button class="bg-indigo-400 text-white px-5 py-2 rounded-lg shadow font-semibold">
      <a href="{{ route('dashboard') }}">Home</a> 
    </button>
  </div>

  <!-- Konten Utama -->
  <main class="min-h-screen flex items-center justify-center px-4 md:px-8 bg-white">
    <!-- Elemen Konten Utama dengan z-index lebih tinggi -->
    <div class="bg-white rounded-xl shadow-xl max-w-6xl w-full p-8 md:p-12 z-10">
      <h1 class="text-center text-2xl md:text-3xl font-light mb-8">Biodata Lengkap</h1>
      
      <div class="flex flex-col md:flex-row justify-between gap-8">
        
        <!-- Kolom Kiri: Label dan Data -->
        <div class="md:w-2/3">
          <div class="grid grid-cols-3 gap-y-4 text-gray-800 text-sm md:text-base">
            <div class="font-normal">{{ __('NISN') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->nisn }}</div>
            
            <div class="font-normal">{{ __('Jenis Kelamin') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->jenis_kelamin }}</div>

            <div class="font-normal">{{ __('Jurusan') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->jurusan_id }}</div>

            <div class="font-normal">{{ __('Kelas') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->room->tingkatan_rooms }}</div>

            <div class="font-normal">{{ __('Telepon') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->telepon }}</div>
            
            <div class="font-normal">{{ __('Agama') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->agama}}</div>

            <div class="font-normal">{{ __('Alamat') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->alamat }}</div>
            
            <div class="font-normal">{{ __('Tanggal Lahir') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->tanggal_lahir }}</div>
            
            <div class="font-normal">{{ __('Golongan Darah') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->gol_darah }}</div>

            <div class="font-normal">{{ __('Status') }}</div>
            <div class="font-light">:</div>
            <div class="font-normal">{{ $biodata->status }}</div>
          </div>
        </div>

        <!-- Kolom Kanan: Foto dan Tombol Edit -->
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
          <a href="{{ route('biodatas.edit') }}" class="mt-4 text-sm text-gray-600 hover:underline self-end">Edit Biodata</a>
        </div>
      </div>
    </div>
  </main>
</x-layouts.app>