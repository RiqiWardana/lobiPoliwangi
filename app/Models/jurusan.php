<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jurusan extends Model
{
    use HasFactory;
    // Spesifikasi Query Table //
    protected $table = 'jurusan';
    protected $guarded = ['id'];

    public function prodi() // Relationship Instansi Lomba //
    {
        return $this->belongsTo(prodi::class);
    }
    public function mahasiswaPrestasi() // Relationship Instansi Lomba //
    {
        return $this->hasMany(mahasiswa_prestasi::class);
    }
}
