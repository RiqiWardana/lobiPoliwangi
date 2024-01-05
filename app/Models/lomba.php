<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lomba extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'lomba';
    protected $guarded = ['id'];

    public function instansiLomba() // Relationship Instansi Lomba //
    {
        return $this->belongsTo(instansi_lomba::class);
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
