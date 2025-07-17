<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Catatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'room_id', 'guru_id', 'tanggal', 'masalah_dibahas', 'tindak_lanjut', 'hasil_akhir', 'poin'
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function guru(): BelongsTo
    {
        return $this->belongsTo(User::class, 'guru_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}