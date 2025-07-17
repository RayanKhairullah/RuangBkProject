<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratPanggilan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_surat', 'tanggal_waktu', 'tempat', 'tujuan', 'room_id', 'biodata_id'
    ];

    public function biodata(): BelongsTo
    {
        return $this->belongsTo(Biodata::class);
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
