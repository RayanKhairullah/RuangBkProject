<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['jurusan_id', 'kode_rooms', 'tingkatan_rooms', 'angkatan_rooms'];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function biodatas(): HasMany
    {
        return $this->hasMany(Biodata::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}