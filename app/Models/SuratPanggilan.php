<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPanggilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'nomor_surat',
        'tanggal_waktu',
        'tempat',
        'tujuan',
        'room_id',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    public function room()
    {
        return $this->belongsTo(\App\Models\Room::class);
    }
}
