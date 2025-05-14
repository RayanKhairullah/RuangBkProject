<x-layouts.app :title="__('Rooms')">
    <div class="mb-6 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Rooms') }}</h1>
        <a href="{{ route('rooms.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-md shadow-md dark:bg-blue-600 dark:hover:bg-blue-700">
            {{ __('Create Room') }}
        </a>
    </div>

    <!-- Filter Section -->
    <div class="mb-4 flex gap-4">
        <!-- Filter Jurusan -->
<div>
    <label for="filterJurusan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Filter Jurusan') }}</label>
    <select id="filterJurusan" class="form-select mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" onchange="filterRooms()">
        <option value="">{{ __('Semua Jurusan') }}</option>
        @foreach ($jurusans as $jurusan)
            <option value="{{ $jurusan->nama_jurusan }}">{{ $jurusan->nama_jurusan }}</option>
        @endforeach
    </select>
</div>

<!-- Filter Tingkatan -->
<div>
    <label for="filterTingkatan" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Filter Tingkatan') }}</label>
    <select id="filterTingkatan" class="form-select mt-1 block w-full border border-gray-300 dark:border-gray-600 rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-300 focus:ring-blue-500 focus:border-blue-500" onchange="filterRooms()">
        <option value="">{{ __('Semua Tingkatan') }}</option>
        @foreach ($tingkatans as $tingkatan)
            <option value="{{ $tingkatan->tingkatan_rooms }}">{{ $tingkatan->tingkatan_rooms }}</option>
        @endforeach
    </select>
</div>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow-md">
        <table class="table-auto w-full border-collapse">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ID') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Kode Kelas') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Jurusan') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Tingkatan Kelas') }}</th>
                    <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody id="roomsTable">
                @foreach ($rooms as $room)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $room->id }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $room->kode_rooms }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $room->jurusan->nama_jurusan }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300">{{ $room->tingkatan_rooms }}</td>
                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-sm text-gray-800 dark:text-gray-300 space-x-2">
                            <a href="{{ route('rooms.edit', $room) }}" class="px-3 py-1 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md shadow-md">{{ __('Edit') }}</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md shadow-md" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                            </form>
                            <a href="{{ route('rooms.show', $room->id) }}" class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md shadow-md">
                                {{ __('View') }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>

<script>
    function filterRooms() {
        const jurusanName = document.getElementById('filterJurusan').value;
        const tingkatan = document.getElementById('filterTingkatan').value;

        const rows = document.querySelectorAll('#roomsTable tr');
        rows.forEach(row => {
            const jurusanCell = row.querySelector('td:nth-child(3)').textContent.trim();
            const tingkatanCell = row.querySelector('td:nth-child(4)').textContent.trim();

            const matchesJurusan = !jurusanName || jurusanCell === jurusanName;
            const matchesTingkatan = !tingkatan || tingkatanCell === tingkatan;

            if (matchesJurusan && matchesTingkatan) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>