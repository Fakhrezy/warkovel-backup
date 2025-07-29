<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default 10 items per page
        $search = $request->get('search');
        $filterPosisi = $request->get('filter_posisi');

        // Build query with search and filter
        $query = Karyawan::query();

        // Search functionality
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('telepon', 'like', '%' . $search . '%');
            });
        }

        // Filter by position
        if ($filterPosisi && $filterPosisi !== 'all') {
            $query->where('posisi', $filterPosisi);
        }

        $karyawan = $query->paginate($perPage)->withQueryString();

        // Get statistics for all employees (not paginated)
        $totalKaryawan = Karyawan::count();
        $countByPosition = [
            'karyawan' => Karyawan::where('posisi', 'karyawan')->count(),
            'barista' => Karyawan::where('posisi', 'barista')->count(),
            'kasir' => Karyawan::where('posisi', 'kasir')->count(),
        ];

        return view('karyawan.index', compact('karyawan', 'totalKaryawan', 'countByPosition'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:17|max:65',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'posisi' => 'required|string|in:karyawan,barista,kasir',
            'gaji' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        Karyawan::create($validated);

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        return view('karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'umur' => 'required|integer|min:17|max:65',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'posisi' => 'required|string|in:karyawan,barista,kasir',
            'gaji' => 'required|numeric|min:0',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        $karyawan->update($validated);

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('karyawan.index')
                        ->with('success', 'Data karyawan berhasil dihapus.');
    }
}
