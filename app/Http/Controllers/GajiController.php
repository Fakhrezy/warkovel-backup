<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gaji;
use App\Models\Karyawan;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gajis = Gaji::with('karyawans')->get();
        return view('gaji.index', compact('gajis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gaji.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'posisi' => 'required|string|unique:gaji,posisi',
            'gaji_pokok' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        Gaji::create([
            'posisi' => $request->posisi,
            'gaji_pokok' => $request->gaji_pokok,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gaji $gaji)
    {
        $gaji->load('karyawans');
        return view('gaji.show', compact('gaji'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gaji $gaji)
    {
        return view('gaji.edit', compact('gaji'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gaji $gaji)
    {
        $request->validate([
            'posisi' => 'required|string|unique:gaji,posisi,' . $gaji->id,
            'gaji_pokok' => 'required|numeric|min:0',
            'is_active' => 'boolean'
        ]);

        $gaji->update([
            'posisi' => $request->posisi,
            'gaji_pokok' => $request->gaji_pokok,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gaji $gaji)
    {
        // Check if there are employees using this position
        $karyawanCount = Karyawan::where('posisi', $gaji->posisi)->count();

        if ($karyawanCount > 0) {
            return redirect()->route('gaji.index')->with('error', 'Tidak dapat menghapus data gaji karena masih ada karyawan dengan posisi ini');
        }

        $gaji->delete();
        return redirect()->route('gaji.index')->with('success', 'Data gaji berhasil dihapus');
    }

    /**
     * Get gaji by posisi for API
     */
    public function getByPosisi($posisi)
    {
        $gaji = Gaji::getByPosisi($posisi);

        if (!$gaji) {
            return response()->json(['message' => 'Gaji untuk posisi tersebut tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gaji
        ]);
    }
}
