<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPanggilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nomor_surat',
        'penyebab',
        'tanggal',
        'waktu',
        'tempat',
        'tujuan',
    ];

    /**
     * Casting attributes ke type Carbon/Date.
     * Dengan ini, $model->tanggal menjadi Carbon instance.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'tanggal' => 'date',        // atau 'datetime' jika butuh waktu juga :contentReference[oaicite:1]{index=1}
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}