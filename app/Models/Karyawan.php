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

    // Accessor untuk format gaji
    public function getFormattedGajiAttribute()
    {
        return 'Rp ' . number_format($this->gaji, 0, ',', '.');
    }

    // Scope untuk filter berdasarkan posisi
    public function scopeByPosisi($query, $posisi)
    {
        return $query->where('posisi', $posisi);
    }
}
