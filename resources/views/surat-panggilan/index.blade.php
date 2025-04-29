<x-layouts.app :title="__('Surat Panggilan')">
    <div class="mb-4 flex justify-between">
        <a href="{{ route('surat-panggilan.create') }}" class="btn btn-primary">{{ __('Buat Surat Panggilan') }}</a>
    </div>

    <x-alerts />

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-black-100">
                    <th class="border border-gray-300 px-4 py-1">{{ __('No') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Nomor Surat') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Nama Siswa') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Tanggal') }}</th>
                    <th class="border border-gray-300 px-4 py-1">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $i => $sp)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $items->firstItem() + $i }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sp->nomor_surat }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sp->siswa->biodata->user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $sp->tanggal->format('d-m-Y') }}</td>
                        <td class="space-x-1">
                            <a href="{{ route('surat-panggilan.show', $sp) }}" class="btn btn-sm btn-secondary">{{ __('View') }}</a>
                            <a href="{{ route('surat-panggilan.edit', $sp) }}" class="btn btn-sm btn-warning">{{ __('Edit') }}</a>
                            <a href="{{ route('surat-panggilan.download', $sp->id) }}" class="btn btn-sm btn-success">{{ __('Download') }}</a>
                            <form action="{{ route('surat-panggilan.destroy', $sp) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('@lang('Are you sure?')')" class="btn btn-sm btn-danger">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>
</x-layouts.app>