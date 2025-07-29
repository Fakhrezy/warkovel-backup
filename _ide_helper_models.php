<?php

namespace App\Models;

/**
 * @mixin \Spatie\Permission\Traits\HasRoles
 * @method bool hasRole($roles, string $guard = null)
 * @method bool hasAnyRole($roles, string $guard = null)
 * @method bool hasAllRoles($roles, string $guard = null)
 * @method bool hasPermissionTo($permission, string $guard = null)
 * @method bool hasAnyPermission($permissions, string $guard = null)
 * @method bool hasAllPermissions($permissions, string $guard = null)
 * @method \Illuminate\Database\Eloquent\Collection assignRole(...$roles)
 * @method \Illuminate\Database\Eloquent\Collection removeRole($role)
 * @method \Illuminate\Database\Eloquent\Collection syncRoles(...$roles)
 * @method \Illuminate\Database\Eloquent\Collection givePermissionTo(...$permissions)
 * @method \Illuminate\Database\Eloquent\Collection revokePermissionTo($permission)
 * @method \Illuminate\Database\Eloquent\Collection syncPermissions(...$permissions)
 * @method \Illuminate\Database\Eloquent\Collection getPermissionsViaRoles()
 * @method \Illuminate\Database\Eloquent\Collection getAllPermissions()
 * @method \Illuminate\Database\Eloquent\Collection getDirectPermissions()
 * @method \Illuminate\Database\Eloquent\Collection getRoleNames()
 * @method \Illuminate\Database\Eloquent\Collection getPermissionNames()
 */
class User {}
