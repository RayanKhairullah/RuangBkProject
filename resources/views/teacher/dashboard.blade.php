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