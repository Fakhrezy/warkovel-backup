<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Menu;
use App\Models\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        $stats = [
            'total_karyawan' => Karyawan::count(),
            'total_menu' => Menu::count(),
            'total_transaksi' => Transaksi::count(),
            'penjualan_hari_ini' => Transaksi::whereDate('tanggal_transaksi', Carbon::today())->sum('total_transaksi'),
            'transaksi_antri' => Transaksi::where('status', 'antri')->count(),
            'transaksi_selesai' => Transaksi::where('status', 'selesai')->count(),
        ];

        // Data untuk Line Chart - Penjualan 7 hari terakhir
        $salesData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $sales = Transaksi::whereDate('tanggal_transaksi', $date)->sum('total_transaksi');
            $salesData[] = [
                'date' => $date->format('d M'),
                'sales' => $sales
            ];
        }

        // Data untuk Bar Chart - Menu paling laku (top 5)
        $topMenus = collect();

        // Get all completed transactions
        $transactions = Transaksi::where('status', 'selesai')->get();
        $menuCounts = [];

        foreach ($transactions as $transaction) {
            $pesanan = $transaction->pesanan; // Menggunakan field 'pesanan' bukan 'detail_pesanan'

            // Handle array format (struktur data yang sebenarnya)
            if (is_array($pesanan)) {
                foreach ($pesanan as $item) {
                    $menuId = $item['menu_id'] ?? null;
                    $jumlah = $item['jumlah'] ?? 1; // Menggunakan 'jumlah' bukan 'quantity'

                    if ($menuId) {
                        $menuCounts[$menuId] = ($menuCounts[$menuId] ?? 0) + $jumlah;
                    }
                }
            }
        }

        // Get top 5 menus with their names
        arsort($menuCounts);
        $topMenuIds = array_slice(array_keys($menuCounts), 0, 5, true);

        foreach ($topMenuIds as $menuId) {
            $menu = Menu::find($menuId);
            if ($menu) {
                $topMenus->push([
                    'nama_menu' => $menu->nama, // Field yang benar adalah 'nama'
                    'total_terjual' => $menuCounts[$menuId]
                ]);
            }
        }

        return view('admin', compact('stats', 'salesData', 'topMenus'));
    }
}
