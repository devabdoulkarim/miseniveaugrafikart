<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['name' => 'Accès backoffice', 'slug' => 'access-admin', 'description' => 'Accéder au panneau d\'administration'],
            ['name' => 'Gérer les articles', 'slug' => 'manage-posts', 'description' => 'Créer, modifier et supprimer des articles'],
            ['name' => 'Gérer les catégories', 'slug' => 'manage-categories', 'description' => 'Créer, modifier et supprimer des catégories'],
            ['name' => 'Gérer les tags', 'slug' => 'manage-tags', 'description' => 'Créer, modifier et supprimer des tags'],
            ['name' => 'Gérer les utilisateurs', 'slug' => 'manage-users', 'description' => 'Voir et gérer les comptes utilisateurs'],
            ['name' => 'Gérer les rôles', 'slug' => 'manage-roles', 'description' => 'Créer, modifier et supprimer des rôles'],
        ];

        foreach ($permissions as $data) {
            Permission::firstOrCreate(['slug' => $data['slug']], $data);
        }

        $roles = [
            [
                'role' => ['name' => 'Administrateur', 'slug' => 'admin', 'description' => 'Accès complet à toutes les fonctionnalités'],
                'permissions' => ['access-admin', 'manage-posts', 'manage-categories', 'manage-tags', 'manage-users', 'manage-roles'],
            ],
            [
                'role' => ['name' => 'Rédacteur', 'slug' => 'editor', 'description' => 'Gère les articles, catégories et tags'],
                'permissions' => ['access-admin', 'manage-posts', 'manage-categories', 'manage-tags'],
            ],
            [
                'role' => ['name' => 'Auteur', 'slug' => 'author', 'description' => 'Peut créer et gérer ses propres articles'],
                'permissions' => ['access-admin', 'manage-posts'],
            ],
        ];

        foreach ($roles as $item) {
            $role = Role::firstOrCreate(['slug' => $item['role']['slug']], $item['role']);
            $permissionIds = Permission::whereIn('slug', $item['permissions'])->pluck('id');
            $role->permissions()->sync($permissionIds);
        }

        $adminRole = Role::where('slug', 'admin')->first();
        User::all()->each(fn (User $user) => $user->roles()->syncWithoutDetaching([$adminRole->id]));
    }
}
