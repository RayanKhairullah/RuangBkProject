<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Panggilan Orang Tua Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0 40px;
        }
        .kop {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop img {
            max-height: 80px;
            margin-bottom: 10px;
        }
        .kop h1 {
            font-size: 20px;
            margin: 0;
        }
        .kop h2 {
            font-size: 16px;
            margin: 5px 0;
            font-weight: normal;
        }
        .kop p {
            margin: 2px 0;
            font-size: 12px;
        }
        .content {
            margin-top: 10px;
            font-size: 12px;
            text-align: justify;
        }
        .content ul {
            margin: 5px 0 15px 20px;
        }
        .signature {
            margin-top: 40px;
            font-size: 12px;
        }
        .signature .name {
            margin-top: 60px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    {{-- KOP SURAT --}}
    <div class="kop">
        <img src="{{ public_path('logo-sekolah.png') }}" alt="Logo Sekolah">
        <h1>{{ $nama_sekolah }}</h1>
        <h2>{{ $alamat_sekolah }}</h2>
        <p>Telp/Email: {{ $telepon_sekolah }}</p>
        <p><strong>Nomor:</strong> {{ $nomor_surat }}</p>
    </div>

    {{-- LAMPIRAN & PERIHAL --}}
    <div class="content">
        <p><strong>Lampiran:</strong> —</p>
        <p><strong>Perihal:</strong> Panggilan Orang Tua Siswa</p>

        <p>Kepada Yth.</p>
        <p>Bapak/Ibu {{ $nama_orang_tua }}</p>
        <p>{{ $alamat_orang_tua }}</p>
        <p>di Tempat</p>

        <p>Dengan Hormat,</p>
        <p>
            Bersama surat ini, kami dari <strong>{{ $nama_sekolah }}</strong> memanggil
            Bapak/Ibu Orang Tua/Wali dari:
        </p>
        <ul>
            <li>Nama Siswa: <strong>{{ $nama_siswa }}</strong></li>
            <li>Kelas: <strong>{{ $kelas }}</strong></li>
            <li>NISN: <strong>{{ $nisn }}</strong></li>
        </ul>

        <p>Sehubungan dengan <strong>{{ $penyebab }}</strong>, kami mengharapkan kehadiran Bapak/Ibu dalam pertemuan yang akan dilaksanakan pada:</p>
        <ul>
            <li>Tanggal: {{ $tanggal }}</li>
            <li>Jam: {{ $waktu }}</li>
            <li>Tempat: {{ $tempat }}</li>
        </ul>

        <p><strong>Tujuan Pertemuan:</strong> {{ $tujuan }}</p>

        <p>Demikian surat panggilan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="signature">
        <p>Hormat Kami,</p>
        <p class="name">{{ $nama_kepala_sekolah }}</p>
        <p>{{ $jabatan_kepala_sekolah }}</p>
        <p>{{ $nama_sekolah }}, {{ $tanggal }}</p>
    </div>
</body>
</html>