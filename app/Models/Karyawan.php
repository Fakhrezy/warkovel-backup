<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';

    protected $fillable = [
        'user_id',
        'nama',
        'umur',
        'jenis_kelamin',
        'alamat',
        'posisi',
        'gaji',
        'status'
    ];

    protected $casts = [
        'gaji' => 'decimal:0',
        'umur' => 'integer'
    ];

    /**
     * Relasi ke model Kehadiran
     */
    public function kehadirans()
    {
        return $this->hasMany(Kehadiran::class);
    }

    /**
     * Relasi ke model User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Gaji berdasarkan posisi
     */
    public function gajiPosisi()
    {
        return $this->belongsTo(Gaji::class, 'posisi', 'posisi')->where('is_active', true);
    }

    /**
     * Boot method untuk eager loading
     */
    protected static function boot()
    {
        parent::boot();

        // Auto load relasi gajiPosisi ketika model di-load
        static::addGlobalScope('withGajiPosisi', function ($builder) {
            $builder->with('gajiPosisi');
        });
    }

    // Accessor untuk format gaji
    public function getFormattedGajiAttribute()
    {
        return 'Rp ' . number_format($this->gaji, 0, ',', '.');
    }

    /**
     * Get gaji dari tabel gaji berdasarkan posisi
     * Ini akan menggantikan kolom gaji dengan nilai dari tabel gaji
     */
    public function getGajiAttribute($value)
    {
        // Jika ada relasi gajiPosisi, gunakan gaji_pokok dari sana
        if ($this->gajiPosisi && $this->gajiPosisi->is_active) {
            return $this->gajiPosisi->gaji_pokok;
        }

        // Fallback ke nilai asli jika tidak ada di tabel gaji
        return $value ?? 0;
    }

    /**
     * Get gaji dari tabel gaji berdasarkan posisi (method lama, di-keep untuk compatibility)
     */
    public function getGajiFromPosisiAttribute()
    {
        $gajiPosisi = $this->gajiPosisi;
        return $gajiPosisi ? $gajiPosisi->gaji_pokok : ($this->attributes['gaji'] ?? 0);
    }

    /**
     * Get formatted gaji from posisi
     */
    public function getFormattedGajiFromPosisiAttribute()
    {
        return 'Rp ' . number_format($this->gaji_from_posisi, 0, ',', '.');
    }

    // Scope untuk filter berdasarkan posisi
    public function scopeByPosisi($query, $posisi)
    {
        return $query->where('posisi', $posisi);
    }
}
