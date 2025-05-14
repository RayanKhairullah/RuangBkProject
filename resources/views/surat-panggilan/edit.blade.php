<x-layouts.app :title="__('Edit Surat Panggilan')">
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ __('Edit Surat Panggilan') }}</h1>
        
        <form action="{{ route('surat-panggilan.update', $suratPanggilan) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            @include('partials._form')
            
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>