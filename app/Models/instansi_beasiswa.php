<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instansi_beasiswa extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'instansi_beasiswa';
    protected $guarded = ['id'];

    public function beasiswa() // Relationship Beasiswa //
    {
        return $this->hasMany(beasiswa::class);
    }
}
