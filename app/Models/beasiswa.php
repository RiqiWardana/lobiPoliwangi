<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beasiswa extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'beasiswa';
    protected $guarded = ['id'];

    // Relationship //
    public function instansiBeasiswa() // Relationship Instansi Beasiswa //
    {
        return $this->belongsTo(instansi_beasiswa::class);
    }
    public function status() // Relationship Status //
    {
        return $this->belongsTo(status::class);
    }
    public function tingkatan() // Relationship Tingkatan //
    {
        return $this->belongsTo(tingkatan::class);
    }
    public function accountAdmin() // Relationship Account Admin //
    {
        return $this->belongsTo(account_admin::class);
    }
}
