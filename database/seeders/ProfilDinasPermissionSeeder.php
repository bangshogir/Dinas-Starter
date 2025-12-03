<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilDinasPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'profil-dinas.read',
            'profil-dinas.update',
        ];

        foreach ($permissions as $permission) {
            \Spatie\Permission\Models\Permission::firstOrCreate(['name' => $permission]);
        }

        $roles = ['Super Admin', 'Admin'];

        foreach ($roles as $roleName) {
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $roleName]);
            $role->givePermissionTo($permissions);
        }
    }
}
