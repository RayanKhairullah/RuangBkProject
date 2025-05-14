<x-layouts.app :title="__('Teacher Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-800 dark:text-gray-100">{{ __('Dashboard') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-600 dark:text-gray-300">{{ __('Manage the Modules data from here:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @session('success')
    <p class="text-green-600 dark:text-green-400">{{ $value }}</p>
    @endsession

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        {{-- User Info --}}
        <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-2">{{ __('Account Info') }} <strong>{{ auth()->user()->name }}</strong></h2>
            <p>{{ __('Role:') }} <strong>{{ ucfirst(auth()->user()->role->value) }}</strong></p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="mt-4 px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded">{{ __('Sign Out') }}</button>
            </form>
        </div>

        {{-- User Stats --}}
        <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow w-48 h-48 mx-auto">
            <h2 class="text-lg font-semibold mb-2">{{ __('User Statistics') }}</h2>
            <ul>
                <li>{{ __('Total Users:') }} <strong>{{ $totalUsers }}</strong></li>
                <li>{{ __('Total Teachers/Admins:') }} <strong>{{ $totalTeachers }}</strong></li>
            </ul>
                 <canvas id="userStatsChart" style="max-width: 200px; max-height: 200px;"></canvas>
        </div>

        {{-- Surat Panggilan Chart (Center-Bottom) --}}
        <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow col-span-full lg:col-span-3">
            <h2 class="text-lg font-semibold mb-2">{{ __('Surat Panggilan Per Month') }}</h2>
            <canvas id="suratPanggilanChart" width="500" height="250"></canvas>
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
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            color: '#4caf50', // Light mode
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
    });
</script>
