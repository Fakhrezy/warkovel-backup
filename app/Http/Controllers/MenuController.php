<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $filterKategori = $request->get('filter_kategori');

        // Build query with search and filter
        $query = Menu::query();

        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('resep', 'like', '%' . $search . '%');
            });
        }

        // Filter by kategori
        if ($filterKategori && $filterKategori !== 'all') {
            $query->where('kategori', $filterKategori);
        }

        $menus = $query->paginate($perPage)->withQueryString();

        // Get statistics
        $totalMenus = Menu::count();
        $countByKategori = [
            'minuman' => Menu::where('kategori', 'minuman')->count(),
            'makanan' => Menu::where('kategori', 'makanan')->count(),
        ];

        return view('menu.index', compact('menus', 'totalMenus', 'countByKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'resep' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:minuman,makanan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/menu'), $filename);
            $data['gambar'] = 'menu/' . $filename;
        }

        Menu::create($data);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        return view('menu.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu)
    {
        return view('menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'resep' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'kategori' => 'required|in:minuman,makanan',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($menu->gambar && file_exists(public_path('storage/' . $menu->gambar))) {
                unlink(public_path('storage/' . $menu->gambar));
            }

            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/menu'), $filename);
            $data['gambar'] = 'menu/' . $filename;
        }

        $menu->update($data);

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu)
    {
        // Delete image file if exists
        if ($menu->gambar && file_exists(public_path('storage/' . $menu->gambar))) {
            unlink(public_path('storage/' . $menu->gambar));
        }

        $menu->delete();

        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus!');
    }
}
