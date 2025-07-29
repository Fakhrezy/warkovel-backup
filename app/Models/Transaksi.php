<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'tanggal_transaksi',
        'pesanan',
        'total_transaksi',
        'status',
        'barista_id',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
        'pesanan' => 'array',
        'total_transaksi' => 'decimal:2',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            if (empty($transaksi->kode_transaksi)) {
                $transaksi->kode_transaksi = self::generateKodeTransaksi();
            }
        });
    }

    // Accessor untuk format tanggal
    public function getFormattedTanggalTransaksiAttribute()
    {
        return $this->tanggal_transaksi->format('d M Y');
    }

    // Accessor untuk format currency
    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total_transaksi, 0, ',', '.');
    }

    // Accessor untuk format currency (backward compatibility)
    public function getFormattedTotalTransaksiAttribute()
    {
        return 'Rp ' . number_format($this->total_transaksi, 0, ',', '.');
    }

    // Accessor untuk total items
    public function getTotalItemsAttribute()
    {
        if (!$this->pesanan) return 0;
        return collect($this->pesanan)->sum('jumlah');
    }

    // Method untuk generate kode transaksi
    public static function generateKodeTransaksi()
    {
        $today = Carbon::now()->format('Ymd');
        $lastTransaction = self::whereDate('tanggal_transaksi', Carbon::today())
                              ->orderBy('id', 'desc')
                              ->first();

        $sequence = $lastTransaction ?
            intval(substr($lastTransaction->kode_transaksi, -3)) + 1 : 1;

        return 'TRX' . $today . str_pad($sequence, 3, '0', STR_PAD_LEFT);
    }

    // Method untuk mendapatkan detail pesanan
    public function getDetailPesananAttribute()
    {
        $details = [];
        foreach ($this->pesanan as $item) {
            // Handle both old and new data structure
            if (isset($item['nama_menu'])) {
                // New structure with nama_menu stored
                $details[] = [
                    'nama_menu' => $item['nama_menu'],
                    'harga' => $item['harga'],
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $item['subtotal']
                ];
            } else {
                // Old structure - fetch from Menu model
                $menu = \App\Models\Menu::find($item['menu_id']);
                $harga = $menu ? $menu->harga : 0;
                $details[] = [
                    'nama_menu' => $menu ? $menu->nama : 'Menu tidak ditemukan',
                    'harga' => $harga,
                    'jumlah' => $item['jumlah'],
                    'subtotal' => $harga * $item['jumlah']
                ];
            }
        }
        return $details;
    }

    // Scope untuk filter berdasarkan status
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeTanggal($query, $tanggal)
    {
        return $query->whereDate('tanggal_transaksi', $tanggal);
    }

    // Relationship dengan User (barista)
    public function barista()
    {
        return $this->belongsTo(User::class, 'barista_id');
    }
}
