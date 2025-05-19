<x-layouts.app :title="__('Dashboard Siswa')">
  <div class="container mx-auto px-4">
    {{-- MOBILE SIDEBAR --}}
    <div id="sidebar" class="fixed inset-y-0 right-0 w-64 bg-white transform translate-x-full transition-transform md:hidden z-40">
      <div class="p-6 flex justify-between items-center">
        <h2 class="font-bold text-lg">{{ __('Menu') }}</h2>
        <button onclick="toggleSidebar()">
          <!-- your back arrow SVG -->
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>
      <div class="p-6">
        <ul class="space-y-1">
          <li>
            <a href="#home" onclick="toggleSidebar()" class="block font-bold hover:text-black">
              {{ __('Home') }}
            </a>
          </li>
          <li>
            <a href="#riwayat-pelanggaran" onclick="toggleSidebar()" class="block font-bold hover:text-black">
              {{ __('Pelanggaran') }}
            </a>
          </li>
          <li>
            <a href="#structure" onclick="toggleSidebar()" class="block font-bold hover:text-black">
              {{ __('Structure') }}
            </a>
          </li>
          <li>
            <a href="{{ route('biodatas.show') }}" onclick="toggleSidebar()" class="block font-bold hover:text-black">
              {{ __('Biodata') }}
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div id="overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden" onclick="toggleSidebar()"></div>

    {{-- MAIN CONTENT --}}
    <div class="pt-16 pb-8">
      {{-- Section HOME --}}
      <section id="home" class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
        <div class="space-y-6">
          <p class="text-3xl font-bold">Hi, {{ auth()->user()->name }}!</p>
          <h1 class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-blue-800 via-yellow-400 to-orange-500 bg-clip-text text-transparent">
            Selamat Datang<br>Di RuangBk!
          </h1>
          <a href="#" class="inline-block px-6 py-3 border-2 rounded-lg bg-gradient-to-r from-blue-800 to-yellow-400 text-white hover:scale-105 transition">
            {{ __('Konseling') }}
          </a>
        </div>
        <div>
          <img src="{{ asset('images/garfisSide.png') }}" alt="Graphic" class="w-full h-auto rounded-lg shadow">
        </div>
      </section>

    {{-- Section RIWAYAT PELANGGARAN --}}
    <section id="riwayat-pelanggaran" class="py-12">
    <form method="GET" action="{{ route('dashboard') }}" class="max-w-md mx-auto mb-6">
        <div class="relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
            <!-- search icon SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 16l-4-4m0 0l4-4m-4 4h18"/>
            </svg>
        </span>
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="{{ __('Cari Kasus') }}"
            class="w-full pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
        />
        </div>
    </form>

    {{-- Tabel Catatan --}}
    @include('partials.catatan-table')
    </section>

      {{-- Section STRUCTURE --}}
      <section id="structure" class="text-center py-12">
        <h2 class="text-2xl sm:text-3xl font-bold">{{ __('Mekanisme Penanganan Kasus') }}</h2>
        <h2 class="text-2xl sm:text-3xl font-bold">{{ __('di SMKN 1 KOTA BENGKULU') }}</h2>
        <div class="mt-8">
          <img src="{{ asset('images/structure1.jpg') }}" alt="Alur Kasus" class="mx-auto w-full max-w-lg rounded-lg shadow">
        </div>
      </section>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-white py-6">
      <div class="container mx-auto px-4 text-center">
        <ul class="flex flex-wrap justify-center space-x-6 font-bold mb-4">
          <li><a href="#home" class="hover:underline">{{ __('Home') }}</a></li>
          <li><a href="#riwayat-pelanggaran" class="hover:underline">{{ __('Riwayat Pelanggaran') }}</a></li>
          <li><a href="#structure" class="hover:underline">{{ __('Structure') }}</a></li>
        </ul>
        <hr class="my-4">
        <p class="text-sm">&copy; 2024 All rights reserved ‖ By Veritas Group</p>
      </div>
    </footer>
  </div>

  @push('scripts')
  <script>
    function toggleSidebar() {
      const sb = document.getElementById('sidebar');
      const ov = document.getElementById('overlay');
      sb.classList.toggle('translate-x-full');
      ov.classList.toggle('hidden');
    }
  </script>
  @endpush
</x-layouts.app>