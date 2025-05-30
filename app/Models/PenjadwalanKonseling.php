<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjadwalanKonseling extends Model
{
    use HasFactory;

    protected $fillable = [
        'pengirim_id',
        'nama_pengirim',
        'penerima_id',
        'nama_penerima',
        'lokasi',
        'tanggal',
        'topik_dibahas',
        'solusi',
        'status',
    ];

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    public function penerima()
    {
        return $this->belongsTo(User::class, 'penerima_id');
    }

    protected $casts = [
        'tanggal' => 'datetime',
    ];
}