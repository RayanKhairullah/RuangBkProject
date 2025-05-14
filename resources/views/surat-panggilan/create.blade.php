<x-layouts.app :title="__('Buat Surat Panggilan')">
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Buat Surat Panggilan') }}</h1>
        
        <form action="{{ route('surat-panggilan.store') }}" method="POST" class="space-y-6">
            @csrf
            
            @include('partials._form')
            
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md">
                    {{ __('Simpan') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>