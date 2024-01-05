<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prestasi extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'prestasi';
    protected $guarded = ['id'];

    // Relationship Table //
    public function mahasiswaPrestasi() // Relationship Mahasiswa //
    {
        return $this->belongsTo(mahasiswa_prestasi::class);
    }
    public function tingkatan() // Relationship Mahasiswa //
    {
        return $this->belongsTo(tingkatan::class);
    }
}
