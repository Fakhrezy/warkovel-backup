<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BaristaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Get orders in queue (antri status)
        $antrianOrders = Transaksi::where('status', 'antri')
            ->orderBy('created_at', 'asc')
            ->get();

        // Get orders being processed
        $prosesOrders = Transaksi::where('status', 'proses')
            ->orderBy('created_at', 'asc')
            ->get();

        // Get completed orders today
        $completedToday = Transaksi::where('status', 'selesai')
            ->whereDate('created_at', Carbon::today())
            ->count();

        return view('barista.dashboard', compact(
            'user',
            'antrianOrders',
            'prosesOrders',
            'completedToday'
        ));
    }

    public function startOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'antri') {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak dalam status antri'
            ], 400);
        }

        $transaksi->update([
            'status' => 'proses',
            'barista_id' => Auth::id(),
            'started_at' => Carbon::now()
        ]);

        // Get detailed recipe information for each menu item
        $detailResep = [];
        foreach ($transaksi->pesanan as $pesananItem) {
            if (isset($pesananItem['menu_id'])) {
                $menu = Menu::find($pesananItem['menu_id']);
                if ($menu) {
                    $detailResep[] = [
                        'nama_menu' => $menu->nama,
                        'quantity' => $pesananItem['jumlah'] ?? $pesananItem['quantity'] ?? 1,
                        'resep' => $menu->resep ?? 'Resep tidak tersedia',
                        'kategori' => $menu->kategori,
                        'harga' => $menu->harga
                    ];
                }
            } else {
                // Handle case where menu is stored directly in pesanan (new format)
                $detailResep[] = [
                    'nama_menu' => $pesananItem['nama'] ?? $pesananItem['nama_menu'] ?? 'Menu tidak diketahui',
                    'quantity' => $pesananItem['jumlah'] ?? $pesananItem['quantity'] ?? 1,
                    'resep' => 'Resep tidak tersedia untuk format pesanan ini',
                    'kategori' => 'Tidak diketahui',
                    'harga' => $pesananItem['harga'] ?? 0
                ];
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dimulai',
            'resep_detail' => $detailResep,
            'kode_transaksi' => $transaksi->kode_transaksi
        ]);
    }

    public function completeOrder(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'proses') {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak dalam status proses'
            ], 400);
        }

        $transaksi->update([
            'status' => 'selesai',
            'completed_at' => Carbon::now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diselesaikan'
        ]);
    }

    public function getOrderDetails($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Enhance pesanan data with recipe information
        $enhancedPesanan = [];
        foreach ($transaksi->pesanan as $pesananItem) {
            $pesananData = $pesananItem;

            // Try to get recipe from menu table if menu_id exists
            if (isset($pesananItem['menu_id'])) {
                $menu = Menu::find($pesananItem['menu_id']);
                if ($menu) {
                    $pesananData['resep'] = $menu->resep ?? 'Resep tidak tersedia';
                    $pesananData['kategori'] = $menu->kategori;
                    // Ensure nama is available - use from menu if not in pesanan
                    if (empty($pesananData['nama'])) {
                        $pesananData['nama'] = $menu->nama;
                    }
                }
            } else {
                $pesananData['resep'] = 'Resep tidak tersedia untuk format pesanan ini';
                $pesananData['kategori'] = 'Menu';
            }

            // Final fallback for nama
            if (empty($pesananData['nama'])) {
                $pesananData['nama'] = 'Menu tidak diketahui';
            }

            $enhancedPesanan[] = $pesananData;
        }

        return response()->json([
            'success' => true,
            'data' => [
                'kode_transaksi' => $transaksi->kode_transaksi,
                'total_harga' => $transaksi->total_transaksi,
                'pesanan' => $enhancedPesanan,
                'created_at' => $transaksi->created_at->format('d/m/Y H:i'),
                'status' => $transaksi->status
            ]
        ]);
    }
}
