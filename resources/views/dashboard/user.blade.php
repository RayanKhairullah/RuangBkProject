<x-layouts.app :title="__('Dashboard Siswa')">
  <div class="container mx-auto px-4">
    {{-- MAIN CONTENT --}}
    <div class="pb-16">
      {{-- Section HOME --}}
      <section id="home" class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
        <div class="space-y-6">
          <p class="text-3xl font-bold">Hi, {{ auth()->user()->name }}!</p>
          <h1 class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-blue-800 via-yellow-400 to-orange-500 bg-clip-text text-transparent">
            Selamat Datang<br>Di RuangBk!
          </h1>
          <a href="{{ route('penjadwalan.index') }}" class="inline-block px-6 py-3 border-2 rounded-lg bg-gradient-to-r from-blue-800 to-yellow-400 text-white hover:scale-105 transition">
            {{ __('Konseling') }}
          </a>
        </div>
        <div>
          <img src="{{ asset('images/garfisSide.png') }}" alt="Graphic" class="w-full h-auto rounded-lg shadow">
        </div>
      </section>

      {{-- Pop-up for Biodata --}}
      @if (!auth()->user()->biodata) {{-- Kondisi jika biodata belum diisi --}}
          <div x-data="{ open: false }" x-init="setTimeout(() => open = true, 3000)" x-show="open" class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm">
              <!-- Pop-up Content -->
              <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="relative bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg max-w-md w-full">
                  <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100 mb-4">{{ __('Isi Biodata Anda') }}</h2>
                  <p class="text-sm text-gray-600 dark:text-gray-400 mb-6">{{ __('Anda harus mengisi biodata terlebih dahulu sebelum melanjutkan.') }}</p>
                  <div class="flex justify-end space-x-4">
                      <a href="{{ route('biodatas.edit') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md">
                          {{ __('Isi Biodata') }}
                      </a>
                      <button @click="open = false" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg shadow-md">
                          {{ __('Nanti') }}
                      </button>
                  </div>
              </div>
          </div>
      @endif

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
      <section id="structure" class="text-center py-12 pt-16">
        <h2 class="text-2xl sm:text-3xl font-bold uppercase">{{ __('Mekanisme Penanganan Kasus BK') }}</h2>
        <h2 class="text-2xl sm:text-3xl font-bold">{{ __('SMKN 1 KOTA BENGKULU') }}</h2>
        <div class="mt-8">
          <img src="{{ asset('images/structure1.png') }}" alt="Alur Kasus" class="mx-auto w-500 rounded-lg shadow">
        </div>
      </section>
    </div>

    {{-- FOOTER --}}
    <footer class="py-6">
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
</x-layouts.app>