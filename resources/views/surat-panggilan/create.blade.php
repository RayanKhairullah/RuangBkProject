<x-layouts.app :title="__('Buat Surat Panggilan')">
    <form action="{{ route('surat-panggilan.store') }}" method="POST" class="max-w-lg">
        @csrf
        
        @include('partials._form')
        
        <button type="submit" class="btn btn-primary">{{ __('Simpan') }}</button>
    </form>
</x-layouts.app>