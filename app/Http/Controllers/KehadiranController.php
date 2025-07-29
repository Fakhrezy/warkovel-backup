<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $search = $request->get('search');
        $filterStatus = $request->get('filter_status');
        $filterBulan = $request->get('filter_bulan');
        $filterTahun = $request->get('filter_tahun');

        // Build query with relations and limit to current year only
        $currentYear = Carbon::now()->year;
        $query = Kehadiran::with('karyawan')
                          ->whereYear('tanggal', $currentYear);

        // Apply month filter (optional)
        if ($filterBulan) {
            $query->whereMonth('tanggal', $filterBulan);
        }

        // Note: Year filter is not needed since we only show current year        // Search functionality
        if ($search) {
            $query->whereHas('karyawan', function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        // Filter by status
        if ($filterStatus && $filterStatus !== 'all') {
            $query->where('status_kehadiran', $filterStatus);
        }

        $kehadirans = $query->orderBy('tanggal', 'desc')
                           ->orderBy('created_at', 'desc')
                           ->paginate($perPage)
                           ->withQueryString();

        // Get statistics (also limited to current year only)
        $statsQuery = Kehadiran::whereYear('tanggal', $currentYear);

        // Apply same filters to stats if provided
        if ($filterBulan) {
            $statsQuery->whereMonth('tanggal', $filterBulan);
        }

        $totalKehadiran = $statsQuery->count();

        // Create base query for status statistics
        $statusStatsQuery = clone $statsQuery;

        $countByStatus = [
            'hadir' => (clone $statusStatsQuery)->where('status_kehadiran', 'hadir')->count(),
            'tidak_hadir' => (clone $statusStatsQuery)->where('status_kehadiran', 'tidak_hadir')->count(),
            'izin' => (clone $statusStatsQuery)->where('status_kehadiran', 'izin')->count(),
            'sakit' => (clone $statusStatsQuery)->where('status_kehadiran', 'sakit')->count(),
        ];        // Get available months and years for filter
        $availableMonths = [
            ['value' => '01', 'label' => 'Januari'],
            ['value' => '02', 'label' => 'Februari'],
            ['value' => '03', 'label' => 'Maret'],
            ['value' => '04', 'label' => 'April'],
            ['value' => '05', 'label' => 'Mei'],
            ['value' => '06', 'label' => 'Juni'],
            ['value' => '07', 'label' => 'Juli'],
            ['value' => '08', 'label' => 'Agustus'],
            ['value' => '09', 'label' => 'September'],
            ['value' => '10', 'label' => 'Oktober'],
            ['value' => '11', 'label' => 'November'],
            ['value' => '12', 'label' => 'Desember'],
        ];

        return view('kehadiran.index', compact(
            'kehadirans',
            'totalKehadiran',
            'countByStatus',
            'availableMonths',
            'filterBulan',
            'currentYear'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = Karyawan::where('status', 'aktif')->orderBy('nama')->get();
        return view('kehadiran.create', compact('karyawans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status_kehadiran' => 'required|in:hadir,tidak_hadir,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if kehadiran already exists for this karyawan and date
        $existing = Kehadiran::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->first();

        if ($existing) {
            return back()->withErrors(['tanggal' => 'Data kehadiran untuk karyawan ini pada tanggal tersebut sudah ada.']);
        }

        Kehadiran::create($request->all());

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        $kehadiran->load('karyawan');
        return view('kehadiran.show', compact('kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        $karyawans = Karyawan::where('status', 'aktif')->orderBy('nama')->get();
        return view('kehadiran.edit', compact('kehadiran', 'karyawans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'nullable|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'status_kehadiran' => 'required|in:hadir,tidak_hadir,izin,sakit',
            'keterangan' => 'nullable|string|max:500'
        ]);

        // Check if kehadiran already exists for this karyawan and date (except current record)
        $existing = Kehadiran::where('karyawan_id', $request->karyawan_id)
                            ->where('tanggal', $request->tanggal)
                            ->where('id', '!=', $kehadiran->id)
                            ->first();

        if ($existing) {
            return back()->withErrors(['tanggal' => 'Data kehadiran untuk karyawan ini pada tanggal tersebut sudah ada.']);
        }

        $kehadiran->update($request->all());

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran berhasil dihapus!');
    }
}
