<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Export Catatan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #888; padding: 4px 8px; }
        th { background: #f3f3f3; }
    </style>
</head>
<body>
    <h2>Data Catatan</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Siswa</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Masalah Dibahas</th>
                <th>Tindak Lanjut</th>
                <th>Hasil Akhir</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach($catatans as $catatan)
            <tr>
                <td>{{ $catatan->siswa->name ?? '-' }}</td>
                <td>{{ $catatan->guru->name ?? '-' }}</td>
                <td>
                    @if($catatan->room && $catatan->room->jurusan)
                        {{ $catatan->room->jurusan->nama_jurusan ?? '-' }}-{{ $catatan->room->kode_rooms ?? '-' }}-{{ $catatan->room->tingkatan_rooms ?? '-' }}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $catatan->tanggal ?? '-' }}</td>
                <td>{{ $catatan->masalah_dibahas ?? '-' }}</td>
                <td>{{ $catatan->tindak_lanjut ?? '-' }}</td>
                <td>{{ $catatan->hasil_akhir ?? '-' }}</td>
                <td>{{ $catatan->poin ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
