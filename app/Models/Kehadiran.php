<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kehadiran extends Model
{
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'status_kehadiran',
        'keterangan'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_masuk' => 'datetime:H:i',
        'jam_keluar' => 'datetime:H:i',
    ];

    /**
     * Relasi ke model Karyawan
     */
    public function karyawan(): BelongsTo
    {
        return $this->belongsTo(Karyawan::class);
    }

    /**
     * Get formatted tanggal
     */
    public function getFormattedTanggalAttribute()
    {
        return $this->tanggal->format('d/m/Y');
    }

    /**
     * Get total jam kerja
     */
    public function getTotalJamKerjaAttribute()
    {
        if (!$this->jam_masuk || !$this->jam_keluar) {
            return null;
        }

        $masuk = \Carbon\Carbon::parse($this->jam_masuk);
        $keluar = \Carbon\Carbon::parse($this->jam_keluar);

        return $masuk->diffInHours($keluar) . ' jam ' . $masuk->diffInMinutes($keluar) % 60 . ' menit';
    }

    /**
     * Scope untuk filter berdasarkan bulan
     */
    public function scopeBulan($query, $bulan, $tahun = null)
    {
        $tahun = $tahun ?? now()->year;
        return $query->whereYear('tanggal', $tahun)->whereMonth('tanggal', $bulan);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status_kehadiran', $status);
    }
}
