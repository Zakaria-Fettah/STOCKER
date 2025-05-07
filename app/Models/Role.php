<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * Créer un rôle avec des permissions
     *
     * @param string $name
     * @param array $permissions
     * @param string $guardName
     * @return Role
     */
    public static function createWithPermissions(string $name, array $permissions, string $guardName = 'web'): Role
    {
        $role = self::create(['name' => $name, 'guard_name' => $guardName]);
        $role->syncPermissions($permissions);
        
        return $role;
    }

    /**
     * Vérifie si un rôle existe déjà
     *
     * @param string $name
     * @param string $guardName
     * @return bool
     */
    public static function existsRole(string $name, string $guardName = 'web'): bool
    {
        return self::where('name', $name)
                   ->where('guard_name', $guardName)
                   ->exists();
    }
}