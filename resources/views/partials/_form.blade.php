@php
    $old = old();
    $data = $suratPanggilan ?? null;
@endphp

<div class="mb-4">
    <label for="user_id" class="block text-sm font-medium">{{ __('Pilih Siswa') }}</label>
    <select name="user_id" id="user_id" class="form-input w-full" required>
        <option value="">{{ __('-- Pilih --') }}</option>
        @foreach ($siswa as $s)
        <option value="{{ $s->id }}"
            {{ (old('user_id', $data ? $data->user_id : '') == $s->id) ? 'selected' : '' }}>
            {{ optional(optional($s->biodata)->user)->name ?? 'Data Tidak Tersedia' }} — 
            Kelas {{ optional(optional($s->biodata)->rooms)->tingkatan_rooms ?? 'N/A' }}
        </option>
        @endforeach
    </select>
    @error('user_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
</div>

@foreach ([
    'nomor_surat' => __('Nomor Surat'),
    'penyebab'    => __('Penyebab'),
    'tanggal'     => __('Tanggal'),
    'waktu'       => __('Waktu'),
    'tempat'      => __('Tempat'),
    'tujuan'      => __('Tujuan Pertemuan'),
] as $field => $label)
    <div class="mb-4">
        <label for="{{ $field }}" class="block text-sm font-medium">{{ $label }}</label>
        <input
            type="{{ $field==='tanggal'?'date':'text' }}"
            name="{{ $field }}"
            id="{{ $field }}"
            value="{{ old($field, $data->{$field} ?? '') }}"
            class="form-input w-full"
            {{ $field==='tujuan'?'':'required' }}
        >
        @error($field)<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>
@endforeach