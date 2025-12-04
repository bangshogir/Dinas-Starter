<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions for User Management
        $userPermissions = [
            'users.create',
            'users.read',
            'users.update',
            'users.delete'
        ];

        // Create permissions for Role Management
        $rolePermissions = [
            'roles.create',
            'roles.read',
            'roles.update',
            'roles.delete'
        ];

        // Create permissions for Permission Management
        $permissionManagementPermissions = [
            'permissions.create',
            'permissions.read',
            'permissions.update',
            'permissions.delete'
        ];

        // Create permissions for System Management
        $systemPermissions = [
            'system.manage',
            'system.settings',
            'system.backup'
        ];

        // Combine all permissions
        $allPermissions = array_merge(
            $userPermissions,
            $rolePermissions,
            $permissionManagementPermissions,
            $systemPermissions
        );

        // Create all permissions (use firstOrCreate to avoid duplicates)
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}