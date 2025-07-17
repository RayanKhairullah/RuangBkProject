<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasFactory;

    protected $fillable = ['nama_jurusan'];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function biodatas(): HasMany
    {
        return $this->hasMany(Biodata::class);
    }
}