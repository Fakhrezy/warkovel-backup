<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kehadiran;
use Carbon\Carbon;

class KaryawanDashboardController extends Controller
{
    /**
     * Display the employee dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->route('dashboard')->with('error', 'Data karyawan tidak ditemukan! Silahkan hubungi administrator.');
        }

        // Cek absensi hari ini
        $today = Carbon::today();
        $absensiHariIni = Kehadiran::where('karyawan_id', $karyawan->id)
                                 ->whereDate('tanggal', $today)
                                 ->first();

        // Statistik bulan ini
        $bulanIni = Carbon::now();

        // Hitung total hari kerja (Senin-Jumat) yang sudah berlalu dalam bulan ini
        $startOfMonth = $bulanIni->copy()->startOfMonth();
        $today = Carbon::today();
        $totalHariKerjaBerlalu = 0;

        // Hitung hari kerja dari awal bulan sampai hari ini (tidak termasuk hari yang belum terjadi)
        for ($date = $startOfMonth->copy(); $date->lte($today) && $date->month == $bulanIni->month; $date->addDay()) {
            // Jika bukan weekend (Sabtu=6, Minggu=0)
            if (!$date->isWeekend()) {
                $totalHariKerjaBerlalu++;
            }
        }

        $kehadiranBulanIni = Kehadiran::where('karyawan_id', $karyawan->id)
                                    ->whereMonth('tanggal', $bulanIni->month)
                                    ->whereYear('tanggal', $bulanIni->year)
                                    ->get();

        $totalHadir = $kehadiranBulanIni->where('jam_masuk', '!=', null)->count();
        $totalTidakHadir = $totalHariKerjaBerlalu - $totalHadir;
        $persentaseHadir = $totalHariKerjaBerlalu > 0 ? round(($totalHadir / $totalHariKerjaBerlalu) * 100, 1) : 0;

        $statistik = [
            'total_hadir' => $totalHadir,
            'total_tidak_hadir' => $totalTidakHadir,
            'persentase_hadir' => $persentaseHadir
        ];

        // Riwayat absensi minggu ini
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $riwayatMingguIni = Kehadiran::where('karyawan_id', $karyawan->id)
                                   ->whereBetween('tanggal', [$startOfWeek, $endOfWeek])
                                   ->orderBy('tanggal', 'desc')
                                   ->get();

        return view('karyawan.absensi', compact('absensiHariIni', 'statistik', 'riwayatMingguIni'));
    }

    /**
     * Handle employee check-in/check-out.
     */
    public function absensi(Request $request)
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->back()->with('error', 'Data karyawan tidak ditemukan!');
        }

        $action = $request->input('action'); // 'masuk' atau 'keluar'
        $today = Carbon::today();
        $now = Carbon::now();

        $absensiHariIni = Kehadiran::where('karyawan_id', $karyawan->id)
                                 ->whereDate('tanggal', $today)
                                 ->first();

        if ($action === 'masuk') {
            // Absen Masuk
            if ($absensiHariIni && $absensiHariIni->jam_masuk) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');
            }

            // Buat record baru atau update yang sudah ada
            if (!$absensiHariIni) {
                Kehadiran::create([
                    'karyawan_id' => $karyawan->id,
                    'tanggal' => $today,
                    'jam_masuk' => $now->format('H:i:s'),
                    'status_kehadiran' => 'hadir',
                ]);
            } else {
                $absensiHariIni->update([
                    'jam_masuk' => $now->format('H:i:s'),
                    'status_kehadiran' => 'hadir',
                ]);
            }

            $jamMasukText = $now->format('H:i:s');

            return redirect()->back()->with('success', "Absen masuk berhasil pada {$jamMasukText}. Selamat bekerja!");

        } elseif ($action === 'keluar') {
            // Absen Keluar
            if (!$absensiHariIni || !$absensiHariIni->jam_masuk) {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk hari ini.');
            }

            if ($absensiHariIni->jam_keluar) {
                return redirect()->back()->with('error', 'Anda sudah melakukan absen keluar hari ini.');
            }

            $absensiHariIni->update([
                'jam_keluar' => $now->format('H:i:s'),
            ]);

            $jamKeluarText = $now->format('H:i:s');
            return redirect()->back()->with('success', "Absen keluar berhasil pada {$jamKeluarText}. Terima kasih atas kerja keras Anda!");
        }

        return redirect()->back()->with('error', 'Aksi tidak valid.');
    }

    /**
     * Show employee profile.
     */
    public function profile()
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->route('karyawan.dashboard')->with('error', 'Data karyawan tidak ditemukan!');
        }

        return view('karyawan.profile', compact('karyawan'));
    }

    /**
     * Show employee attendance history.
     */
    public function riwayatAbsensi()
    {
        $user = Auth::user();
        $karyawan = $user->karyawan;

        if (!$karyawan) {
            return redirect()->route('karyawan.dashboard')->with('error', 'Data karyawan tidak ditemukan!');
        }

        $riwayat = Kehadiran::where('karyawan_id', $karyawan->id)
                           ->orderBy('tanggal', 'desc')
                           ->paginate(15);

        return view('karyawan.riwayat-absensi', compact('riwayat'));
    }
}
