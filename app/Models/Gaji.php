<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 'gaji';

    protected $fillable = [
        'posisi',
        'gaji_pokok',
        'is_active'
    ];

    protected $casts = [
        'gaji_pokok' => 'decimal:0',
        'is_active' => 'boolean'
    ];

    /**
     * Relasi ke model Karyawan berdasarkan posisi
     */
    public function karyawans()
    {
        return $this->hasMany(Karyawan::class, 'posisi', 'posisi');
    }

    /**
     * Accessor untuk total gaji (sekarang sama dengan gaji pokok)
     */
    public function getTotalGajiAttribute()
    {
        return $this->gaji_pokok;
    }

    /**
     * Accessor untuk format gaji pokok
     */
    public function getFormattedGajiPokokAttribute()
    {
        return 'Rp ' . number_format($this->gaji_pokok, 0, ',', '.');
    }

    /**
     * Accessor untuk format total gaji
     */
    public function getFormattedTotalGajiAttribute()
    {
        return 'Rp ' . number_format($this->total_gaji, 0, ',', '.');
    }

    /**
     * Scope untuk posisi aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get gaji by posisi
     */
    public static function getByPosisi($posisi)
    {
        return self::where('posisi', $posisi)->where('is_active', true)->first();
    }
}
