<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa_prestasi extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'mahasiswa_prestasi';
    protected $guarded = ['id'];

    public function prestasi() // Relationship Prestasi Mahasiswa //
    {
        return $this->belongsTo(prestasi::class);
    }
    public function jurusan() // Relationship Account Admin //
    {
        return $this->belongsTo(jurusan::class);
    }
    public function accountAdmin() // Relationship Account Admin //
    {
        return $this->belongsTo(account_admin::class);
    }
}
