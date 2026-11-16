<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pelanggan',
        'nama_lengkap',
        'no_hp',
        'alamat',
        'pekerjaan',
    ];

    public function daftarServices(): HasMany
    {
        return $this->hasMany(DaftarService::class);
    }
}