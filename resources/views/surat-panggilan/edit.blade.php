<x-layouts.app :title="__('Edit Surat Panggilan')">
    <form action="{{ route('surat-panggilan.update', $suratPanggilan) }}" method="POST" class="max-w-lg">
        @csrf @method('PUT')
        
        @include('partials._form')
        
        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
    </form>
</x-layouts.app>