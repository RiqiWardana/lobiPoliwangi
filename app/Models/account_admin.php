<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

// Custom Auth Config //
use Illuminate\Foundation\Auth\User as Model;

class account_admin extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'account_admin';
    protected $guarded = ['id'];

    // Casting Table Description //
    protected $casts = [
        'password' => 'hashed', // Password Hashing //
    ];

    // Relationship //
    public function beasiswa() // Relationship Account Admin //
    {
        return $this->hasMany(beasiswa::class);
    }
    public function lomba() // Relationship Account Admin //
    {
        return $this->hasMany(lomba::class);
    }
    public function mahasiswaPrestasi() // Relationship Account Admin //
    {
        return $this->hasMany(mahasiswa_prestasi::class);
    }
}
