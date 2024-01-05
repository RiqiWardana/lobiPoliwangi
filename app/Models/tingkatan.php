<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tingkatan extends Model
{
    use HasFactory;

     // Spesifikasi Query Table //
     protected $table = 'tingkatan';
     protected $guarded = ['id'];
 
    // Relationship //
    public function beasiswa()
    {
        return $this->hasMany(beasiswa::class);
    }
    public function lomba()
    {
        return $this->hasMany(lomba::class);
    }
    public function prestasi()
    {
        return $this->hasMany(prestasi::class);
    }
}
