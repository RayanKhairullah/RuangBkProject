<div>
    <label class="block font-medium mb-2">{{ $label ?? 'Upload File' }}</label>
    <input
        type="file"
        name="{{ $name ?? 'file' }}"
        id="{{ $id ?? 'file-upload' }}"
        class="block w-full border border-gray-300 rounded-md p-2"
        {{ $attributes }}
    >
</div>