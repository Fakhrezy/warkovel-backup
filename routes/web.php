<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    /** @var \App\Models\User $user */
    $user = Auth::user();

    // Redirect berdasarkan role user
    if ($user && $user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    // Kasir redirect ke halaman kasir
    if ($user && $user->hasRole('kasir')) {
        return redirect()->route('kasir.dashboard');
    }

    // Barista redirect ke halaman barista
    if ($user && $user->hasRole('barista')) {
        return redirect()->route('barista.dashboard');
    }

    // Semua staff (semua posisi) ke halaman absensi
    if ($user && $user->hasRole('staff')) {
        return redirect()->route('karyawan.dashboard');
    }

    // Legacy: Untuk role lama yang mungkin masih ada
    if ($user && $user->hasRole('karyawan')) {
        return redirect()->route('karyawan.dashboard');
    }    // Default dashboard untuk user tanpa role khusus
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'admin'])->name('admin.dashboard');

    // Route untuk mengelola karyawan
    Route::resource('karyawan', \App\Http\Controllers\KaryawanController::class);

    // Route untuk mengelola menu
    Route::resource('menu', \App\Http\Controllers\MenuController::class);

    // Route untuk mengelola kehadiran
    Route::resource('kehadiran', \App\Http\Controllers\KehadiranController::class);

    // Route untuk mengelola user
    Route::resource('users', \App\Http\Controllers\UserController::class);

    // Route untuk mengelola transaksi
    Route::resource('transaksi', \App\Http\Controllers\TransaksiController::class);
});

// Kasir - Sistem POS untuk kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir', [\App\Http\Controllers\KasirController::class, 'dashboard'])->name('kasir.dashboard');
    Route::get('/kasir/transaksi', [\App\Http\Controllers\KasirController::class, 'transaksi'])->name('kasir.transaksi');
    Route::get('/kasir/menu', [\App\Http\Controllers\KasirController::class, 'menu'])->name('kasir.menu');

    // Cart functionality
    Route::post('/kasir/cart/add', [\App\Http\Controllers\KasirController::class, 'addToCart'])->name('kasir.cart.add');
    Route::post('/kasir/cart/remove', [\App\Http\Controllers\KasirController::class, 'removeFromCart'])->name('kasir.cart.remove');
    Route::post('/kasir/cart/update', [\App\Http\Controllers\KasirController::class, 'updateCart'])->name('kasir.cart.update');
    Route::post('/kasir/cart/clear', [\App\Http\Controllers\KasirController::class, 'clearCart'])->name('kasir.cart.clear');
    Route::post('/kasir/checkout', [\App\Http\Controllers\KasirController::class, 'checkout'])->name('kasir.checkout');
});

// Barista - Sistem antrian dan pembuatan pesanan
Route::middleware(['auth', 'role:barista'])->group(function () {
    Route::get('/barista', [\App\Http\Controllers\BaristaController::class, 'dashboard'])->name('barista.dashboard');
    Route::post('/barista/orders/{id}/start', [\App\Http\Controllers\BaristaController::class, 'startOrder'])->name('barista.orders.start');
    Route::post('/barista/orders/{id}/complete', [\App\Http\Controllers\BaristaController::class, 'completeOrder'])->name('barista.orders.complete');
    Route::get('/barista/orders/{id}/details', [\App\Http\Controllers\BaristaController::class, 'getOrderDetails'])->name('barista.orders.details');
});

// Absensi untuk semua staff (semua posisi)
Route::middleware(['auth', 'role:staff'])->group(function () {
    // Absensi - halaman utama untuk semua staff
    Route::get('/absensi', [\App\Http\Controllers\KaryawanDashboardController::class, 'index'])->name('karyawan.dashboard');
    Route::post('/absensi', [\App\Http\Controllers\KaryawanDashboardController::class, 'absensi'])->name('karyawan.absensi');
    Route::get('/karyawan/profile', [\App\Http\Controllers\KaryawanDashboardController::class, 'profile'])->name('karyawan.profile');
    Route::get('/karyawan/riwayat-absensi', [\App\Http\Controllers\KaryawanDashboardController::class, 'riwayatAbsensi'])->name('karyawan.riwayat');

    // Route tambahan untuk posisi tertentu (opsional)
    Route::get('/antrian', function () {
        return 'Halaman Barista - Antrian';
    });
    Route::get('/staff', function () {
        return 'Halaman Staff';
    })->name('staff.dashboard');
});

// Legacy: Route untuk role karyawan lama (jika masih ada)
Route::middleware(['auth', 'role:karyawan'])->group(function () {
    Route::get('/absensi-legacy', [\App\Http\Controllers\KaryawanDashboardController::class, 'index']);
});

require __DIR__.'/auth.php';

// Debug routes untuk setup kasir (hapus setelah selesai debugging)
Route::middleware(['auth'])->group(function () {
    Route::get('/debug/kasir-setup', [\App\Http\Controllers\DebugController::class, 'checkKasirSetup']);
    Route::post('/debug/create-kasir-role', [\App\Http\Controllers\DebugController::class, 'createKasirRole']);
    Route::post('/debug/assign-kasir-role', [\App\Http\Controllers\DebugController::class, 'assignKasirRole']);

    // Cart testing route
    Route::get('/debug/cart-test', function() {
        return view('cart_test');
    });
});
