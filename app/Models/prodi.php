<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prodi extends Model
{
    use HasFactory;
    // Spesifikasi Query Table //
    protected $table = 'prodi';
    protected $guarded = ['id'];

    public function jurusan() // Relationship Instansi Lomba //
    {
        return $this->hasMany(jurusan::class);
    }
}
