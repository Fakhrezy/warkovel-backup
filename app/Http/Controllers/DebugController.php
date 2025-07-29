<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;

class DebugController extends Controller
{
    public function checkKasirSetup()
    {
        $user = Auth::user();

        $debug = [
            'current_user' => $user ? [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('name')->toArray(),
                'has_kasir_role' => $user->hasRole('kasir'),
            ] : 'No authenticated user',

            'all_roles' => Role::all()->pluck('name')->toArray(),
            'kasir_role_exists' => Role::where('name', 'kasir')->exists(),

            'all_users_with_roles' => User::with('roles')->get()->map(function($u) {
                return [
                    'name' => $u->name,
                    'email' => $u->email,
                    'roles' => $u->roles->pluck('name')->toArray()
                ];
            })
        ];

        return response()->json($debug, 200, [], JSON_PRETTY_PRINT);
    }

    public function createKasirRole()
    {
        // Buat role kasir
        $role = Role::firstOrCreate(['name' => 'kasir']);

        return response()->json([
            'success' => true,
            'message' => $role->wasRecentlyCreated ? 'Role kasir berhasil dibuat' : 'Role kasir sudah ada',
            'role' => $role
        ]);
    }

    public function assignKasirRole(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ]);

        $user = User::where('email', $request->email)->first();
        $user->assignRole('kasir');

        return response()->json([
            'success' => true,
            'message' => "Role kasir berhasil di-assign ke {$user->name}",
            'user' => [
                'name' => $user->name,
                'email' => $user->email,
                'roles' => $user->roles->pluck('name')->toArray()
            ]
        ]);
    }
}
