<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodatas';

    protected $fillable = [
        'user_id', 'nama_siswa', 'nisn','jurusan_id', 'room_id', 'jenis_kelamin',
        'tempat_lahir', 'tanggal_lahir', 'telepon', 'agama',
        'alamat_ktp', 'alamat_domisili', 'cita_cita', 'hobi', 'minat_bakat',
        'sd', 'smp', 'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah',
        'nama_ibu', 'pekerjaan_ibu', 'no_hp_ibu', 'gol_darah', 'status', 'image',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}