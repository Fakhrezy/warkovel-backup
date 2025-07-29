<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'nama',
        'resep',
        'harga',
        'kategori',
        'gambar'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    /**
     * Get formatted price
     */
    public function getFormattedHargaAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
