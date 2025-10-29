<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'dokter_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'is_aktif',
    ];

    /**
     * Relasi ke model Dokter
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    /**
     * Relasi ke Periksa
     */
    public function periksas()
    {
        return $this->hasMany(Periksa::class, 'id_jadwal');
    }

    /**
     * Scope untuk hanya ambil jadwal aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('is_aktif', true);
    }

     public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class, 'id');
    }
}
