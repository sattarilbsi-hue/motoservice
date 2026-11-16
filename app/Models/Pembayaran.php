<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'daftar_service_id',
        'jumlah_biaya_servis',
        'jenis_pembayaran',
        'keterangan',
    ];

    public function daftarService(): BelongsTo
    {
        return $this->belongsTo(DaftarService::class);
    }
}