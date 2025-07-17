<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Biodata {{ $biodata->user->name }}</title>
    <style>
        @page { margin: 0.5cm; }
        body { 
            font-family: Arial, sans-serif; 
            line-height: 1.3; 
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }
        .header { 
            text-align: center; 
            margin-bottom: 10px; 
        }
        .header h1 { 
            margin: 0; 
            padding: 0; 
            font-size: 14pt;
        }
        .header p {
            margin: 2px 0;
            font-size: 10pt;
        }
        .photo { 
            float: right; 
            margin: 0 0 10px 20px;
            text-align: center;
        }
        .photo img { 
            width: 100px; 
            height: 120px;
            object-fit: cover;
            border: 1px solid #333; 
        }
        .section { 
            margin-bottom: 8px;
            page-break-inside: avoid;
        }
        .section h2 { 
            background-color: #f5f5f5; 
            padding: 4px 8px; 
            border-left: 3px solid #4a5568;
            font-size: 11pt;
            margin: 8px 0 5px 0;
        }
        .info-grid { 
            display: grid; 
            grid-template-columns: 100px 1fr; 
            gap: 4px 8px;
            font-size: 9pt;
        }
        .label { 
            font-weight: bold; 
            color: #4a5568;
        }
        .signature { 
            position: absolute;
            bottom: 1cm;
            right: 1cm;
            text-align: right;
            font-size: 9pt;
        }
        .signature-line { 
            border-top: 1px solid #000; 
            width: 150px; 
            display: inline-block;
            margin-top: 40px;
        }
        h3 {
            margin: 5px 0;
            font-size: 10pt;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BIODATA PESERTA DIDIK</h1>
        <p>SMK NEGERI 1 CONTOH KOTA</p>
    </div>

    <div class="photo">
        @if($biodata->image)
            <img src="{{ storage_path('app/public/' . $biodata->image) }}" alt="Foto Profil">
        @else
            <div style="width: 100px; height: 120px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; font-size: 8pt;">
                <span>No Photo</span>
            </div>
        @endif
    </div>

    <div class="section">
        <h2>DATA PRIBADI</h2>
        <div class="info-grid">
            <div class="label">Nama Lengkap</div>
            <div>{{ $biodata->user->name }}</div>
            
            <div class="label">NISN</div>
            <div>{{ $biodata->nisn ?? '-' }}</div>
            
            <div class="label">Kelas</div>
            <div>{{ $biodata->room->kode_rooms ?? '-' }}</div>
            
            <div class="label">Jenis Kelamin</div>
            <div>{{ $biodata->jenis_kelamin ?? '-' }}</div>
            
            <div class="label">Tempat, Tgl Lahir</div>
            <div>{{ ($biodata->tempat_lahir ?? '-') . ', ' . ($biodata->tanggal_lahir ? \Carbon\Carbon::parse($biodata->tanggal_lahir)->format('d/m/Y') : '-') }}</div>
            
            <div class="label">Agama</div>
            <div>{{ $biodata->agama ?? '-' }}</div>
            
            <div class="label">Gol. Darah</div>
            <div>{{ $biodata->gol_darah ?? '-' }}</div>
            
            <div class="label">Alamat KTP</div>
            <div>{{ $biodata->alamat_ktp ?? '-' }}</div>
            
            @if($biodata->alamat_domisili && $biodata->alamat_domisili !== $biodata->alamat_ktp)
            <div class="label">Alamat Domisili</div>
            <div>{{ $biodata->alamat_domisili }}</div>
            @endif
            
            <div class="label">Telepon</div>
            <div>{{ $biodata->telepon ? '+62' . $biodata->telepon : '-' }}</div>
        </div>
    </div>

    <div class="section">
        <h2>DATA ORANG TUA</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
            <div>
                <h3>Ayah</h3>
                <div class="info-grid">
                    <div class="label">Nama</div>
                    <div>{{ $biodata->nama_ayah ?? '-' }}</div>
                    
                    <div class="label">Pekerjaan</div>
                    <div>{{ $biodata->pekerjaan_ayah ?? '-' }}</div>
                    
                    <div class="label">No. HP</div>
                    <div>{{ $biodata->no_hp_ayah ? '+62' . $biodata->no_hp_ayah : '-' }}</div>
                </div>
            </div>
            
            <div>
                <h3>Ibu</h3>
                <div class="info-grid">
                    <div class="label">Nama</div>
                    <div>{{ $biodata->nama_ibu ?? '-' }}</div>
                    
                    <div class="label">Pekerjaan</div>
                    <div>{{ $biodata->pekerjaan_ibu ?? '-' }}</div>
                    
                    <div class="label">No. HP</div>
                    <div>{{ $biodata->no_hp_ibu ? '+62' . $biodata->no_hp_ibu : '-' }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" style="margin-bottom: 2cm;">
        <h2>INFORMASI TAMBAHAN</h2>
        <div class="info-grid">
            <div class="label">Cita-cita</div>
            <div>{{ $biodata->cita_cita ?? '-' }}</div>
            
            <div class="label">Hobi</div>
            <div>{{ $biodata->hobi ?? '-' }}</div>
            
            <div class="label">Minat & Bakat</div>
            <div>{{ $biodata->minat_bakat ?? '-' }}</div>
        </div>
    </div>

    <div class="signature" style="text-align: right;">
        <div style="margin-top: 60px;">
            <p>Hormat kami,</p>
            <div class="signature-line"></div>
            <p>Wali Kelas</p>
        </div>
    </div>
</body>
</html>
