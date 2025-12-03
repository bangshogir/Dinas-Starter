<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ArticlePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Article permissions
        $articlePermissions = [
            'articles.create',
            'articles.read',
            'articles.update',
            'articles.delete',
        ];

        // Category permissions (using existing content permissions)
        $categoryPermissions = [
            'content.create',
            'content.read',
            'content.update',
            'content.delete',
        ];

        // Combine all permissions
        $allPermissions = array_merge($articlePermissions, $categoryPermissions);

        // Create permissions
        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to roles
        $roles = [
            'Super Admin' => $allPermissions,
            'Admin' => $allPermissions,
            'Author' => array_merge(
                ['articles.create', 'articles.read', 'articles.update', 'articles.delete'],
                ['content.read'] // Authors can read categories but not manage them
            ),
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->givePermissionTo($permissions);
        }

        $this->command->info('Article permissions seeded successfully.');
    }
}