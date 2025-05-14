<x-layouts.app :title="__('User Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1" class="text-gray-800 dark:text-gray-100">{{ __('User Dashboard') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6 text-gray-600 dark:text-gray-300">{{ __('Welcome to your dashboard! Here you can manage your data and access various features.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    {{-- Pop-up for Biodata --}}
    @if (!$user->biodata_filled) {{-- Kondisi jika biodata belum diisi --}}
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

    {{-- Account Info --}}
    <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow">
        <h2 class="text-lg font-semibold mb-2">{{ __('Welcome') }} <strong>{{ auth()->user()->name }}</strong></h2>
        <p>{{ __('Role:') }} <strong>{{ ucfirst($user->role->value) }}</strong></p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('This section shows your account information, including your name and role.') }}</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-red-500 dark:bg-red-600 text-white rounded hover:bg-red-600">{{ __('Sign Out') }}</button>
        </form>
    </div>

    {{-- Biodata Section --}}
    <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow mt-6">
        <h2 class="text-lg font-semibold mb-2">{{ __('Biodata') }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Mengedit Biodata Anda') }}</p>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Silahkan isi biodata Anda dengan benar dan lengkap.') }}</p>
        <a href="{{ route('biodatas.edit') }}" class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600">{{ __('Edit Biodata') }}</a>
    </div>

    {{-- Catatan Section --}}
    <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow mt-6">
        <h2 class="text-lg font-semibold mb-2">{{ __('Catatan Prilaku') }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('melihat catatan perilaku yang telah dibuat oleh guru BK.') }}</p>
        <a href="{{ route('catatans.index') }}" class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600">{{ __('View Catatan') }}</a>
    </div>

    {{-- Penjadwalan Konseling Section --}}
    <div class="p-4 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-200 rounded-lg shadow mt-6">
        <h2 class="text-lg font-semibold mb-2">{{ __('Penjadwalan Konseling') }}</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ __('Untuk Mengatur jadwal konseling dengan guru BK.') }}</p>
        <a href="{{ route('penjadwalan.index') }}" class="px-4 py-2 bg-blue-500 dark:bg-blue-600 text-white rounded hover:bg-blue-600">{{ __('View Jadwal') }}</a>
    </div>
</x-layouts.app>