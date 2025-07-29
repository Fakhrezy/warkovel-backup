<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KasirController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();

        // Data untuk dashboard kasir
        $totalTransaksiHari = Transaksi::whereDate('created_at', today())->count();
        $totalPendapatanHari = Transaksi::whereDate('created_at', today())
            ->where('status', 'selesai')
            ->sum('total_transaksi');

        $transaksiTerbaru = Transaksi::whereDate('created_at', today())
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil semua menu untuk POS
        $menuTersedia = Menu::all();

        // Grup menu berdasarkan kategori
        $menuMakanan = Menu::where('kategori', 'makanan')->get();
        $menuMinuman = Menu::where('kategori', 'minuman')->get();

        return view('kasir.dashboard', compact(
            'user',
            'totalTransaksiHari',
            'totalPendapatanHari',
            'transaksiTerbaru',
            'menuTersedia',
            'menuMakanan',
            'menuMinuman'
        ));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'jumlah' => 'required|integer|min:1'
        ]);

        $menu = Menu::find($request->menu_id);
        $jumlah = $request->jumlah;

        // Simpan cart dalam session
        $cart = session()->get('cart', []);

        if(isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['jumlah'] += $jumlah;
            $cart[$request->menu_id]['subtotal'] = $cart[$request->menu_id]['jumlah'] * $menu->harga;
        } else {
            $cart[$request->menu_id] = [
                'id' => $menu->id,
                'nama' => $menu->nama,
                'harga' => $menu->harga,
                'jumlah' => $jumlah,
                'subtotal' => $menu->harga * $jumlah,
                'gambar' => $menu->gambar
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil ditambahkan ke keranjang',
            'cart_count' => count($cart),
            'cart_total' => array_sum(array_column($cart, 'subtotal'))
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required'
        ]);

        $cart = session()->get('cart', []);

        if(isset($cart[$request->menu_id])) {
            unset($cart[$request->menu_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus dari keranjang',
            'cart_count' => count($cart),
            'cart_total' => array_sum(array_column($cart, 'subtotal'))
        ]);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'jumlah' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        $menu = Menu::find($request->menu_id);

        if(isset($cart[$request->menu_id])) {
            $cart[$request->menu_id]['jumlah'] = $request->jumlah;
            $cart[$request->menu_id]['subtotal'] = $request->jumlah * $menu->harga;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil diupdate',
            'cart_count' => count($cart),
            'cart_total' => array_sum(array_column($cart, 'subtotal'))
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Keranjang berhasil dikosongkan'
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'Keranjang kosong'
            ], 400);
        }

        // Hitung total transaksi
        $totalTransaksi = array_sum(array_column($cart, 'subtotal'));

        // Siapkan data pesanan
        $pesanan = [];
        foreach ($cart as $item) {
            $pesanan[] = [
                'menu_id' => $item['id'],
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'jumlah' => $item['jumlah'],
                'subtotal' => $item['subtotal']
            ];
        }

        // Simpan transaksi ke database
        $transaksi = Transaksi::create([
            'tanggal_transaksi' => now(),
            'pesanan' => $pesanan,
            'total_transaksi' => $totalTransaksi,
            'status' => 'antri' // Status antri untuk diproses barista/dapur
        ]);

        // Clear cart setelah checkout
        session()->forget('cart');

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil disimpan',
            'kode_transaksi' => $transaksi->kode_transaksi,
            'total' => $totalTransaksi
        ]);
    }    public function transaksi()
    {
        $transaksi = Transaksi::orderBy('created_at', 'desc')
            ->paginate(20);

        return view('kasir.transaksi', compact('transaksi'));
    }

    public function menu()
    {
        $menu = Menu::all();
        return view('kasir.menu', compact('menu'));
    }
}
