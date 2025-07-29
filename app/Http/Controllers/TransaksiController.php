<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Menu;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query();

        // Filter berdasarkan search (kode transaksi)
        if ($request->filled('search')) {
            $query->where('kode_transaksi', 'like', '%' . $request->search . '%');
        }

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transaksis = $query->latest('tanggal_transaksi')->paginate(15);

        // Preserve query parameters for pagination
        $transaksis->appends($request->query());

        // Get statistics (unfiltered)
        $totalTransaksi = Transaksi::count();
        $transaksiAntri = Transaksi::where('status', 'antri')->count();
        $transaksiSelesai = Transaksi::where('status', 'selesai')->count();

        return view('transaksi.index', compact('transaksis', 'totalTransaksi', 'transaksiAntri', 'transaksiSelesai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $menus = Menu::all();
        return view('transaksi.create', compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'pesanan' => 'required|array',
            'pesanan.*.menu_id' => 'required|exists:menus,id',
            'pesanan.*.jumlah' => 'required|integer|min:1',
            'status' => 'required|in:antri,selesai',
        ]);

        // Hitung total transaksi
        $total = 0;
        $pesananData = [];

        foreach ($request->pesanan as $item) {
            $menu = Menu::find($item['menu_id']);
            $subtotal = $menu->harga * $item['jumlah'];
            $total += $subtotal;

            $pesananData[] = [
                'menu_id' => $menu->id,
                'nama_menu' => $menu->nama,
                'harga' => $menu->harga,
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal,
            ];
        }

        Transaksi::create([
            'kode_transaksi' => Transaksi::generateKodeTransaksi(),
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'pesanan' => $pesananData,
            'total_transaksi' => $total,
            'status' => $request->status,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        return view('transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $menus = Menu::all();
        return view('transaksi.edit', compact('transaksi', 'menus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date',
            'pesanan' => 'required|array',
            'pesanan.*.menu_id' => 'required|exists:menus,id',
            'pesanan.*.jumlah' => 'required|integer|min:1',
            'status' => 'required|in:antri,selesai',
        ]);

        // Hitung total transaksi
        $total = 0;
        $pesananData = [];

        foreach ($request->pesanan as $item) {
            $menu = Menu::find($item['menu_id']);
            $subtotal = $menu->harga * $item['jumlah'];
            $total += $subtotal;

            $pesananData[] = [
                'menu_id' => $menu->id,
                'nama_menu' => $menu->nama,
                'harga' => $menu->harga,
                'jumlah' => $item['jumlah'],
                'subtotal' => $subtotal,
            ];
        }

        $transaksi->update([
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'pesanan' => $pesananData,
            'total_transaksi' => $total,
            'status' => $request->status,
        ]);

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus');
    }
}
