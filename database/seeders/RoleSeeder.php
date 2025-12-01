<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $superAdmin = Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $author = Role::create(['name' => 'Author']);

        // Super Admin gets all permissions
        $superAdmin->givePermissionTo([
            // Users Management
            'users.create',
            'users.read',
            'users.update',
            'users.delete',
            // Roles Management
            'roles.create',
            'roles.read',
            'roles.update',
            'roles.delete',
            // Permissions Management
            'permissions.create',
            'permissions.read',
            'permissions.update',
            'permissions.delete',
            // Articles Management
            'articles.create',
            'articles.read',
            'articles.update',
            'articles.delete',
            // Content Management
            'content.create',
            'content.read',
            'content.update',
            'content.delete',
            // System Management
            'system.manage',
            'system.settings',
            'system.backup'
        ]);

        // Admin gets limited permissions
        $admin->givePermissionTo([
            // Limited Users Management
            'users.read',
            'users.update',
            // Articles Management
            'articles.create',
            'articles.read',
            'articles.update',
            'articles.delete',
            // Content Management
            'content.create',
            'content.read',
            'content.update',
            'content.delete'
        ]);

        // Author gets basic permissions
        $author->givePermissionTo([
            // Articles Management (own articles only)
            'articles.create',
            'articles.read',
            'articles.update',
            // Content Management (own content only)
            'content.create',
            'content.read'
        ]);
    }
}