<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Panggilan Orang Tua</title>
    <style>
        /** Margins untuk PDF **/
        @page { margin: 30mm 20mm 20mm 20mm; }
        body { font-family: Arial, sans-serif; font-size: 12px; line-height:1.5; }

        /* ===== KOP SURAT ===== */
        .kop { text-align: center; margin-bottom: 5px; }
        .kop table { width: 100%; border-collapse: collapse; }
        .kop .logo { width: 15%; }
        .kop .judul { width: 70%; vertical-align: middle; text-align: center;  }
        .kop h1 { margin: 0; font-size: 16px; text-transform: uppercase; }
        .kop h2 { margin: 2px 0; font-size: 14px; font-weight: normal; }
        .kop p  { margin: 1px 0; font-size: 10px; }
        hr.double { border: none; border-top: 2px solid #000; margin: 5px 0 15px; }

        /* ===== META SURAT ===== */
        .meta { width:100%; margin-bottom:20px; }
        .meta .left { float:left; width:50%; }
        .meta .right{ float:right;width:50%; text-align:right; }
        .clear { clear:both; }

        /* ===== ISI ===== */
        .isi { text-align: justify; }
        .isi p { margin:6px 0; }
        .isi ul { margin:6px 0 12px 20px; }

        /* ===== TANDA TANGAN ===== */
        .ttd { margin-top:40px; width:100%; margin-bottom: 40px; }
        .ttd .right { float:right; width:40%; text-align:center; }
        .ttd .name { margin-top:60px; font-weight:bold; text-decoration:underline; }

        /* ===== FOOTER PROGRAM STUDI ===== */

        .footer {
            position: fixed;
            font-size: 10px;
        }
        .footer table {
            width: 100%;  
            border-collapse: collapse;
            border-top: 1px solid #000;    /* garis pemisah atas */
            padding-top: 4px;
        }
        .footer td {
            vertical-align: top;
            padding: 6px 4px 0;
        }
        .footer .col-left {
            width: 50%;
        }
        .footer .col-left strong.program-studi {
            font-family: "Monotype Corsiva", cursive;
            font-size: 10px;
        }
         .footer .col-left ol {
            margin: 0;
            padding-left: 1.2em;
        }
        .footer .col-left ol li {
            margin: 2px 0;
            font-size: 8px;
        }
        .footer .col-center {
            width: 25%;
            text-align: center;
        }
        .footer .col-center img {
            max-height: 40px;
            display: block;
            margin: 0 auto 4px;
        }
        .footer .col-center p {
            margin: 0;
            font-style: italic;
            font-size: 9px;
        }
        .footer .col-right a {
            display: inline-block;
            font-size: 10px;
            text-decoration: none;
            margin-left: 8px;
        }
        .footer .col-right img {
            max-height: 14px;
            vertical-align: middle;
            margin-right: 4px;
        }
        .footer .col-right {
            width: 25%;
            text-align: top;          /* Center-align seluruh isi kolom */
            text-align: right; 
            padding-top: 4px;
        }
        .footer-logo {
            max-height: 40px;
            display: block;
            margin-left: auto;
            margin: 0 auto 6px; */
        }
        .social-horizontal {
            display: inline-flex;   /* agar tetap inline dan bisa justify */
            justify-content: flex-end;
            gap: 12px;              /* jarak antar link */
            flex-wrap: wrap;
        }

        .social-horizontal a {
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            font-size: 10px;
        }

        .social-horizontal a img {
            max-height: 14px;
            margin-right: 4px;
        }

        /* Container tautan sosmed */
        .social-links {
            display: flex;
            flex-direction: column;      /* Susun vertikal */
            align-items: center;         /* Tengah secara horizontal */
            row-gap: 4px;                /* Jarak antar baris tautan */
        }

        /* Setiap tautan sosmed */
        .social-links a {
            display: inline-flex;        /* Flex untuk ikon + teks */
            align-items: center;
            text-decoration: none;
            font-size: 10px;
        }

        /* Ikon di setiap tautan */
        .social-links a img {
            max-height: 14px;
            margin-right: 4px;
        }
    </style>
</head>
<body>

    {{-- KOP SURAT (dari DOCX) --}}
    <div class="kop">
        <table>
            <tr>
                <td class="logo">
                    <img src="{{ public_path('images/logoprov.png') }}" alt="Logo" style="max-height:80px;">
                </td>
                <td class="judul">
                    <p>PEMERINTAH PROVINSI BENGKULU</p>
                    <p>DINAS PENDIDIKAN DAN KEBUDAYAAN PROVINSI BENGKULU</p>
                    <h1>SMK Negeri 1 Kota Bengkulu</h1>
                    <p>Jalan Jati Nomor 41, Padang Jati, Ratu Samban, Kota Bengkulu 38228</p>
                    <p>smkn1bengkulu.sch.id | smkn1_bkl@yahoo.co.id</p>
                </td>
                <td class="logo">
                    <img src="{{ public_path('images/logoSmea.png') }}" alt="Logo" style="max-height:80px;">
                </td>
            </tr>
        </table>
        <hr class="double">
    </div>

    {{-- META SURAT --}}
    <div class="meta">
        <div class="left">
            <p><strong>Nomor :</strong> {{ $suratPanggilan->nomor_surat }}</p>
            <p><strong>Lampiran :</strong> –</p>
            <p><strong>Perihal :</strong> Panggilan Orang Tua/Wali</p>
        </div>
        <div class="right">
            <p>Kota Bengkulu, {{ $suratPanggilan->tanggal_waktu->translatedFormat('d F Y') }}</p>
        </div>
        <div class="clear"></div>
    </div>

    {{-- ISI SURAT --}}
    <div class="isi">
        <p>Kepada Yth.</p>
        <p><strong>Orang Tua/Wali</strong> dari <strong>{{ $suratPanggilan->nama_siswa }}</strong></p>

        <p>Dengan hormat,</p>
        <p>Berdasarkan data kami, siswa tersebut adalah:</p>
        <ul>
            <li><strong>Nama Siswa</strong> : {{ $suratPanggilan->nama_siswa }}</li>
            <li><strong>Kelas</strong>      : {{ $suratPanggilan->tingkatan_kelas }}</li>
            <li><strong>Jurusan</strong>    : {{ $suratPanggilan->jurusan }}</li>
        </ul>

        <p>Sehubungan dengan itu, kami menghimbau kehadiran Bapak/Ibu pada:</p>
        <ul>
            <li><strong>Tanggal & Waktu</strong> : {{ $suratPanggilan->tanggal_waktu->translatedFormat('d F Y, H:i') }}</li>
            <li><strong>Tempat</strong>           : {{ $suratPanggilan->tempat }}</li>
        </ul>

        <p><strong>Tujuan Panggilan :</strong></p>
        <p class="whitespace-pre-wrap">{{ $suratPanggilan->tujuan }}</p>

        <p>Demikian pemberitahuan ini kami sampaikan. Atas perhatian dan kehadiran Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd">
        <div class="right">
            <p>Hormat kami,</p>
            <p>SMK Negeri 1 Kota Bengkulu</p>
            <p class="name">{{ $nama_kepala_sekolah }}</p>
            <p>{{ $jabatan_kepala_sekolah }}</p>
        </div>
        <div class="clear"></div>
    </div>

    <div class="footer">
    <table>
        <tr>
        <!-- kiri: daftar program -->
        <td class="col-left">
            <strong class="program-studi">Program Studi Keahlian:</strong>
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

        <!-- Kanan: Logo + Tagline + Sosial (horizontal), flush right -->
        <td class="col-right">
        <img src="{{ public_path('images/logosmeabenklu.jpg') }}"
            alt="SMKN 1 Kota Bengkulu"
            class="footer-logo">

        <div class="social-horizontal">
            <a href="https://instagram.com/smkn1kotabengkulu">
            <img src="{{ public_path('images/icon_instagram.png') }}" alt="IG">
            @smkn1kotabengkulu
            </a>
            <a href="https://facebook.com/Smkn1KotaBengkulu">
            <img src="{{ public_path('images/icon_facebook.png') }}" alt="FB">
            Smkn1 Kota Bengkulu
            </a>
            <a href="https://twitter.com/smkn1kotabkl">
            <img src="{{ public_path('images/icon_twitter.png') }}" alt="TW">
            @smkn1kotabkl
            </a>
        </div>
        </td>
        </tr>
    </table>
    </div>

</body>
</html>