<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use App\Http\Requests\RegisterKaryawanRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterKaryawanRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();

            DB::transaction(function () use ($validated) {
                // Buat user dengan role default staff
                $user = User::create([
                    'name' => $validated['nama'],
                    'email' => $validated['email'],
                    'password' => Hash::make($validated['password']),
                    'role' => 'staff', // Default role staff untuk semua user
                ]);

                // Assign role staff dengan Spatie Permission
                $user->assignRole('staff');

                // Buat data karyawan
                Karyawan::create([
                    'user_id' => $user->id,
                    'nama' => $validated['nama'],
                    'umur' => $validated['umur'],
                    'jenis_kelamin' => $validated['jenis_kelamin'],
                    'alamat' => $validated['alamat'],
                    'posisi' => $validated['posisi'],
                    'gaji' => $validated['gaji'],
                    'status' => 'aktif', // Default status aktif
                ]);

                event(new Registered($user));
                // Tidak auto-login, biarkan user login manual
            });

            return redirect(route('login'))->with('success', 'Registrasi berhasil! Silakan login dengan akun yang baru dibuat.');
        } catch (\Exception $e) {
            // Log error untuk debugging
            Log::error('Registration Error: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return back()->withInput()->withErrors(['error' => 'Terjadi kesalahan saat registrasi: ' . $e->getMessage()]);
        }
    }
}
