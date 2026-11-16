<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DaftarService extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_servis_pelanggan',
        'kendaraan_id',
        'pelanggan_id',
        'keluhan_kendaraan',
        'tanggal_servis',
    ];

    protected $casts = [
        'tanggal_servis' => 'date',
    ];

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function kendaraan(): BelongsTo
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function dataService(): HasOne
    {
        return $this->hasOne(DataService::class);
    }

    public function pembayaran(): HasOne
    {
        return $this->hasOne(Pembayaran::class);
    }
}