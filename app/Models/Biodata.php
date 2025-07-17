<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\User;

class Biodata extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'jenis_kelamin', 'nisn', 'jurusan_id', 'room_id', 'tempat_lahir',
        'tanggal_lahir', 'telepon', 'agama', 'alamat_ktp', 'alamat_domisili', 'cita_cita',
        'hobi', 'minat_bakat', 'nama_ayah', 'pekerjaan_ayah', 'no_hp_ayah', 'nama_ibu',
        'pekerjaan_ibu', 'no_hp_ibu', 'gol_darah', 'image'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function suratPanggilans(): HasMany
    {
        return $this->hasMany(SuratPanggilan::class);
    }
}