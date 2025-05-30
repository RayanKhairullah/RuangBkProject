<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'jurusan_id',
        'kode_rooms',
        'tingkatan_rooms',
        'angkatan_rooms',
        'tahun_ajaran_mulai',
        'tahun_ajaran_berakhir',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'kode_rooms', 'kode_rooms');
    }
}
