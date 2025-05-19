<x-layouts.app :title="__('Teacher Dashboard')">
  <div class="container mx-auto px-4">
    {{-- HEADER --}}
    <header class="mb-8">
      <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ __('Teacher Dashboard') }}</h1>
      <p class="mt-1 text-gray-600 dark:text-gray-300">{{ __('Overview of modules & statistics') }}</p>
      <hr class="mt-4 border-gray-200 dark:border-gray-700">
    </header>

    {{-- CARDS GRID --}}
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 mb-12">
      {{-- User Info --}}
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex flex-col items-center">
          <div class="w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mb-4">
            <img src="{{ asset('images/user.png')}}" alt="">
          </div>
          <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">{{ __('Hi, ') }}{{ auth()->user()->name }}</h2>
          <span class="mt-1 inline-block bg-blue-100 text-blue-800 text-xs font-medium px-2 py-1 rounded">{{ __('Guru-BK') }}</span>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-6 text-center">
          @csrf
          <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded-lg hover:bg-red-600">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
            </svg>
            {{ __('Sign Out') }}
          </button>
        </form>
      </div>

      {{-- Pie Chart --}}
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:-translate-y-1">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">{{ __('User Statistics') }}</h3>
        <div class="h-56">
          <canvas id="userStatsChart"></canvas>
        </div>
      </div>

      {{-- Line Chart --}}
      <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow hover:-translate-y-1">
        <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-4">{{ __('Surat Panggilan/Month') }}</h3>
        <div class="h-56">
          <canvas id="suratPanggilanChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  {{-- Chart.js --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Pie Chart
      new Chart(document.getElementById('userStatsChart'), {
        type: 'pie',
        data: {
          labels: ['{{ __("Users") }}', '{{ __("Teachers") }}'],
          datasets: [{ data: [{{ $totalUsers }}, {{ $totalTeachers }}], backgroundColor: ['#4caf50','#2196f3'] }]
        },
        options: { responsive: true, maintainAspectRatio: false }
      });

      // Line Chart
      const lineData = @json($suratPanggilanData);
      new Chart(document.getElementById('suratPanggilanChart'), {
        type: 'line',
        data: {
          labels: lineData.labels,
          datasets: [{ 
            label: '{{ __("Surat Panggilan") }}', 
            data: lineData.data, 
            borderColor: '#4caf50', 
            fill: false, 
            tension: 0.3 
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
      });
    });
  </script>
</x-layouts.app>