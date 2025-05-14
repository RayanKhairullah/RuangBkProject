<x-layouts.app :title="__('Surat Panggilan')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Surat Panggilan') }}</h1>
        <a href="{{ route('surat-panggilan.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg shadow-md">
            {{ __('Buat Surat Panggilan') }}
        </a>
    </div>

    <x-alerts />

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('No') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nomor Surat') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Nama Siswa') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tanggal') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $i => $sp)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $items->firstItem() + $i }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $sp->nomor_surat }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $sp->siswa->biodata->user->name }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $sp->tanggal->format('d-m-Y') }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300 space-x-2">
                            <a href="{{ route('surat-panggilan.show', $sp) }}" class="px-3 py-1 bg-gray-500 hover:bg-gray-600 text-white rounded-md shadow-md">{{ __('View') }}</a>
                            <a href="{{ route('surat-panggilan.edit', $sp) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow-md">{{ __('Edit') }}</a>
                            <a href="{{ route('surat-panggilan.download', $sp->id) }}" class="px-3 py-1 bg-green-500 hover:bg-green-600 text-white rounded-md shadow-md">{{ __('Download') }}</a>
                            <form action="{{ route('surat-panggilan.destroy', $sp) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
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