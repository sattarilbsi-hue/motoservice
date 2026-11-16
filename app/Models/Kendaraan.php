<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_plat',
        'jenis_kendaraan',
        'no_stnk',
        'tahun_pembuatan',
        'nama_pemilik',
        'warna_kendaraan',
    ];

    public function daftarServices(): HasMany
    {
        return $this->hasMany(DaftarService::class);
    }
}