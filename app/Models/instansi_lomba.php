<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class instansi_lomba extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'instansi_lomba';
    protected $guarded = ['id'];

    // Relationship //
    public function lomba() // Relationship Lomba //
    {
        return $this->hasMany(lomba::class);
    }
}
