<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class status extends Model
{
    use HasFactory;

    // Spesifikasi Query Table //
    protected $table = 'status';
    protected $guarded = ['id'];

    // Relationship //
    public function beasiswa()
    {
        return $this->hasMany(beasiswa::class);
    }
}
