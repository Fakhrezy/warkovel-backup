<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool hasRole($roles, $guard = null)
 * @method bool hasAnyRole($roles, $guard = null)
 * @method bool hasAllRoles($roles, $guard = null)
 * @method bool hasPermissionTo($permission, $guard = null)
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke Karyawan
     */
    public function karyawan()
    {
        return $this->hasOne(Karyawan::class);
    }

    /**
     * Check if user has specific role
     */
    public function hasUserRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is staff
     */
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    /**
     * Check if user is kasir
     */
    public function isKasir()
    {
        return $this->role === 'kasir';
    }

    /**
     * Check if user is barista
     */
    public function isBarista()
    {
        return $this->role === 'barista';
    }
}
