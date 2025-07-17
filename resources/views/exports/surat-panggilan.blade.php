<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Panggilan Orang Tua/Wali - SMK Negeri 1 Kota Bengkulu</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 15mm 15mm 10mm 15mm;
        }
        header, footer {
            position: fixed;
            width: 100%;
        }
        header { top: 0; }
        footer { bottom: 0; }
        body {
            font-size: 11px;
            line-height: 1.4;
            font-family: 'Times New Roman', Times, serif;
        }
        .clear { clear: both; }
        .header-table, .footer-table {
            page-break-inside: avoid;
        }
        .header-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        .header-table td { vertical-align: middle; }
        .logo { max-height: 80px; }
        .header-title { text-align: center; }
        .header-title h1 { margin: 0; font-size: 20px; text-transform: uppercase; }
        .header-title p { margin: 2px 0; font-size: 10px; }
        hr.double { border: none; border-top: 2px solid #000; margin: 5px 0 15px; }
        .meta { width: 100%; margin-bottom: 20px; }
        .meta .left { float: left; width: 50%; }
        .meta .right { float: right; width: 50%; text-align: right; }
        .isi, .ttd { page-break-inside: avoid; }
        .isi { text-align: justify; }
        .isi p { margin: 4px 0; }
        .isi ul, .isi ol { margin: 6px 0 12px 20px; }
        .ttd { width: 100%; margin-top: 40px; margin-bottom: 40px; }
        .ttd .right { float: right; width: 40%; text-align: center; }
        .ttd .name { margin-top: 60px; font-weight: bold; text-decoration: underline; }
        .footer-table { width: 100%; border-collapse: collapse; border-top: 1px solid #000; padding-top: 4px; margin-top: 10px; }
        .footer-table td { vertical-align: top; padding: 6px 4px 0; }
        .col-left { width: 50%; font-size: 10px; }
        .col-left .program span { font-family: "Monotype Corsiva", cursive; font-size: 10px; }
        .col-left ol li { font-size: 8px; margin: 2px 0; }
        .col-right { width: 50%; text-align: right; font-size: 10px; }
        .footer-logo { max-height: 40px; margin-bottom: 6px; }
        .social-horizontal a { display: inline-flex; align-items: center; text-decoration: none; font-size: 10px; }
        .social-horizontal a img { max-height: 14px; margin-right: 4px; padding-top: 18px;}
    </style>
</head>
<body>
    {{-- Header Partial --}}
    <table class="header-table">
        <tr>
            <td><img src="{{ public_path('images/logoprov.png') }}" alt="Logo Provinsi" class="logo" style="max-height:90px; margin-left: 30px"></td>
            <td class="header-title">
                <p>PEMERINTAH PROVINSI BENGKULU</p>
                <p>DINAS PENDIDIKAN DAN KEBUDAYAAN PROVINSI BENGKULU</p>
                <h1>SMK Negeri 1 Kota Bengkulu</h1>
                <p>Jalan Jati Nomor 41, Padang Jati, Ratu Samban, Kota Bengkulu 38228</p>
                <p>smkn1bengkulu.sch.id | smkn1_bkl@yahoo.co.id</p>
            </td>
            <td><img src="{{ public_path('images/logoSmea.png') }}" alt="Logo SMEA" class="logo" style="max-height:100px; margin-left: 20px"></td>
        </tr>
    </table>
    <hr class="double">

    {{-- Meta Surat --}}
    <div class="meta">
        <div class="left">
            <p><strong>Nomor :</strong> {{ $surat->nomor_surat }}</p>
            <p><strong>Lampiran :</strong> -</p>
            <p><strong>Perihal :</strong> Panggilan Orang Tua/Wali</p>
        </div>
        <div class="right">
            <p>Kota Bengkulu, {{ \Carbon\Carbon::parse($surat->tanggal_waktu)->translatedFormat('d F Y') }}</p>
        </div>
        <div class="clear"></div>
    </div>

    {{-- Isi Surat --}}
    <div class="isi">
        <p>Kepada Yth.</p>
        <p><strong>Orang Tua/Wali</strong> dari <strong>{{ $surat->biodata->user->name ?? '-' }}</strong></p>
        <p><strong>Kelas:</strong> {{ $surat->room->tingkatan_rooms ?? '-' }} - {{ $surat->room->jurusan->nama_jurusan ?? '-' }}</p>
        <p>Di Tempat</p>

        <br>
        <p>Dengan hormat,</p>
        <p>Dengan ini kami menghimbau kehadiran Bapak/Ibu pada:</p>
        <ul>
            <li><strong>Tanggal & Waktu</strong>: {{ \Carbon\Carbon::parse($surat->tanggal_waktu)->translatedFormat('d F Y, H:i') }}</li>
            <li><strong>Tempat</strong>: {{ $surat->tempat }}</li>
        </ul>

        <p><strong>Tujuan Panggilan :</strong></p>
        <p class="whitespace-pre-wrap">{{ $surat->tujuan }}</p>

        <p>Demikian pemberitahuan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    {{-- Tanda Tangan --}}
    <div class="ttd">
        <div class="right">
            <p>Hormat kami,</p>
            <p>SMK Negeri 1 Kota Bengkulu</p>
            <p class="name">{{ $nama_kepala_sekolah ?? 'Nama Kepala Sekolah' }}</p>
            <p>{{ $jabatan_kepala_sekolah ?? 'Kepala Sekolah' }}</p>
        </div>
        <div class="clear"></div>
    </div>

    {{-- Footer Partial --}}
    <table class="footer-table">
        <tr>
            <td class="col-left">
                <span class="program">Program Studi Keahlian:</span>
                <ol>
                    <li>Bisnis dan Pemasaran</li>
                    <li>Manajemen Perkantoran dan Layanan Bisnis</li>
                    <li>Usaha Layanan Pariwisata</li>
                    <li>Akuntansi dan Keuangan Lembaga</li>
                    <li>Teknik Jaringan Komputer dan Telekomunikasi</li>
                    <li>Desain Komunikasi Visual</li>
                    <li>Pengembangan Perangkat Lunak dan GIM</li>
                    <li>Animasi</li>
                </ol>
            </td>
            <td class="col-right">
                <img src="{{ public_path('images/logosmeabenklu.jpg') }}" alt="SMKN1 Logo" class="footer-logo">
                <div class="social-horizontal">
                    <a href="https://instagram.com/smkn1kotabengkulu">
                        <img src="{{ public_path('images/instagram.png') }}" alt="IG"> @smkn1kotabengkulu
                    </a>
                    <a href="https://facebook.com/Smkn1KotaBengkulu">
                        <img src="{{ public_path('images/facebook.png') }}" alt="FB"> Smkn1 Kota Bengkulu
                    </a>
                    <a href="https://twitter.com/smkn1kotabkl">
                        <img src="{{ public_path('images/twitter.png') }}" alt="TW"> @smkn1kotabkl
                    </a>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
