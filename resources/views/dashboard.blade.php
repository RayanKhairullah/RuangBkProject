<x-layouts.app :title="__('Teacher Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Dashboard') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Manage the Modules data from here:') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    @session('success')
    <p class="text-green-600">{{ $value }}</p>
    @endsession

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        {{-- 1) Confusion Matrix --}}
        <div class="p-4 bg-white rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-2">{{ __('Confusion Matrix') }}</h2>
          <canvas id="confusionMatrixChart" width="300" height="300"></canvas>
        </div>
      
        {{-- 2) Accuracy & F1 Score --}}
        <div class="p-4 bg-white rounded-lg shadow">
          <h2 class="text-lg font-semibold mb-2">{{ __('Model Metrics') }}</h2>
          <canvas id="metricsDonutChart" width="300" height="300"></canvas>
        </div>
      
        {{-- 3) Accuracy Trend --}}
        <div class="p-4 bg-white rounded-lg shadow col-span-full lg:col-span-2">
          <h2 class="text-lg font-semibold mb-2">{{ __('Accuracy Over Time') }}</h2>
          <canvas id="accuracyLineChart" width="600" height="300"></canvas>
        </div>
    </div>      
</x-layouts.app>

<!-- Chart.js core -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-chart-matrix@3.0.0/dist/chartjs-chart-matrix.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1) Confusion Matrix Data (example 2×2)
        const cmData = [
            { x: 0, y: 0, v: 50 },
            { x: 1, y: 0, v: 10 },
            { x: 0, y: 1, v: 5 },
            { x: 1, y: 1, v: 85 }
        ];

        new Chart(document.getElementById('confusionMatrixChart'), {
            type: 'matrix',
            data: {
                datasets: [{
                    label: 'Confusion Matrix',
                    data: cmData,
                    backgroundColor(ctx) {
                        const val = ctx.dataset.data[ctx.dataIndex].v;
                        return `rgba(${255 * (val / 100)}, 0, ${255 * (1 - val / 100)}, 0.7)`;
                    },
                    // Guard chartArea undefined
                    width: ({ chart }) => {
                        const area = chart.chartArea;
                        return area 
                            ? (area.width / 2) - 1 
                            : (chart.width / 2) - 1;
                    },
                    height: ({ chart }) => {
                        const area = chart.chartArea;
                        return area 
                            ? (area.height / 2) - 1 
                            : (chart.height / 2) - 1;
                    },
                    borderWidth: 1,
                    borderColor: 'black'
                }]
            },
            options: {
                scales: {
                    x: { display: false, min: -0.5, max: 1.5 },
                    y: { display: false, min: -0.5, max: 1.5 }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                const { x, y, v } = ctx.raw;
                                const row = y === 1 ? 'Positive' : 'Negative';
                                const col = x === 1 ? 'Positive' : 'Negative';
                                return `${row}⇢${col}: ${v}`;
                            }
                        }
                    },
                    legend: { display: false }
                }
            }
        });

        // 2) Donut Chart for Accuracy & F1 Score
        new Chart(document.getElementById('metricsDonutChart'), {
            type: 'doughnut',
            data: {
                labels: ['Accuracy', 'F1 Score', 'Remaining'],
                datasets: [{
                    data: [0.92, 0.85, 1 - 0.92],
                    backgroundColor: ['#4caf50', '#2196f3', '#e0e0e0'],
                    hoverOffset: 4
                }]
            },
            options: {
                aspectRatio: 1,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                return `${ctx.label}: ${(ctx.parsed * 100).toFixed(1)}%`;
                            }
                        }
                    }
                }
            }
        });

        // 3) Line Chart for Accuracy Over Time
        new Chart(document.getElementById('accuracyLineChart'), {
            type: 'line',
            data: {
                labels: ['Epoch 1','Epoch 2','Epoch 3','Epoch 4','Epoch 5'],
                datasets: [{
                    label: 'Accuracy',
                    data: [0.76, 0.83, 0.88, 0.91, 0.92],
                    borderColor: '#4caf50',
                    borderWidth: 2,
                    fill: false,
                    tension: 0.2
                }]
            },
            options: {
                scales: {
                    y: {
                        suggestedMin: 0.5,
                        suggestedMax: 1,
                        ticks: {
                            callback: v => `${(v * 100).toFixed(0)}%`
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label(ctx) {
                                return `Accuracy: ${(ctx.parsed.y * 100).toFixed(1)}%`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>