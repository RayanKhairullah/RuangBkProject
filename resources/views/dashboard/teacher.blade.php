<x-layouts.app :title="__('Teacher Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-800 dark:text-gray-100">{{ __('Dashboard') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-600 dark:text-gray-300">{{ __('Manage the Modules data from here:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @session('success')
    <p class="text-green-600 dark:text-green-400">{{ $value }}</p>
    @endsession

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3 h-auto">
        {{-- User Info --}}
        <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow flex flex-col items-center relative transition-transform transform hover:scale-105 hover:shadow-lg hover:bg-white dark:hover:bg-gray-800">
            <!-- Bulatan Foto -->
        <div class="w-24 h-24 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center mb-4">
        <svg class="w-12 h-12 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.28 0 4-1.72 4-4s-1.72-4-4-4-4 1.72-4 4 1.72 4 4 4zm0 2c-3.31 0-6 2.69-6 6v1h12v-1c0-3.31-2.69-6-6-6z" />
        </svg>
    </div>

    <!-- Welcome Text -->
    <div class="text-center">
        <h2 class="text-lg font-semibold mb-1">{{ __('Welcome') }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400">{{ auth()->user()->name }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400 font-semibold mt-1">{{ __('Guru-BK') }}</p>
    </div>

    <!-- Sign Out Button -->
    <form method="POST" action="{{ route('logout') }}" class="absolute bottom-4 left-4">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded">{{ __('Sign Out') }}</button>
    </form>
        </div>

        {{-- Pie Chart (User Stats) --}}
    <div class="card flex flex-col">
        <h2 class="card-title">{{ __('User Statistics') }}</h2>
        <div class="card-body flex-1 flex items-center justify-center">
            <canvas id="userStatsChart" class="w-full h-full max-h-[200px]"></canvas>
        </div>
    </div>

    {{-- Line Chart (Surat Panggilan Per Month) --}}
    <div class="card flex flex-col">
        <h2 class="card-title">{{ __('Surat Panggilan Per Month') }}</h2>
        <div class="card-body flex-1 flex items-center justify-center">
            <canvas id="suratPanggilanChart" class="w-full h-full max-h-[200px]"></canvas>
        </div>
    </div>
    </div>
</x-layouts.app>

<!-- Chart.js core -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Surat Panggilan Chart Data
        const suratPanggilanData = @json($suratPanggilanData);

        new Chart(document.getElementById('suratPanggilanChart'), {
            type: 'line',
            data: {
                labels: suratPanggilanData.labels,
                datasets: [{
                    label: 'Surat Panggilan',
                    data: suratPanggilanData.data,
                    borderColor: '#4caf50',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#4caf50',
                            callback: function(value) {
                                return value;
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                return `${ctx.dataset.label}: ${ctx.parsed.y}`;
                            }
                        }
                    }
                }
            }
        });

        // User Statistics Pie Chart Data
        const userStatsData = {
            labels: ['Total Users', 'Total Teachers/Admins'],
            datasets: [{
                data: [{{ $totalUsers }}, {{ $totalTeachers }}],
                backgroundColor: ['#4caf50', '#2196f3'],
                hoverBackgroundColor: ['#66bb6a', '#42a5f5']
            }]
        };

        new Chart(document.getElementById('userStatsChart'), {
            type: 'pie',
            data: userStatsData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const label = ctx.label || '';
                                const value = ctx.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>