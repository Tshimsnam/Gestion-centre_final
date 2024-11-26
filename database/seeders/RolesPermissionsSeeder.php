<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Créer des permissions spécifiques à votre contexte
        Permission::firstOrCreate(['name' => 'accéder aux rapports']);
        Permission::firstOrCreate(['name' => 'voir les activités']);
        Permission::firstOrCreate(['name' => 'gérer les activités']);
        Permission::firstOrCreate(['name' => 'ajouter des candidats']);
        Permission::firstOrCreate(['name' => 'marquer la présence']);
        Permission::firstOrCreate(['name' => 'gérer les candidats']);
        Permission::firstOrCreate(['name' => 'gérer les utilisateurs']);
        Permission::firstOrCreate(['name' => 'gérer tout']);

        // Créer des rôles et assigner des permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $agentRole = Role::firstOrCreate(['name' => 'agent de sécurité']);
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        // Assigner des permissions aux rôles
        $agentRole->givePermissionTo(['ajouter des candidats', 'voir les activités', 'marquer la présence']);
        $adminRole->givePermissionTo(['gérer les activités', 'accéder aux rapports', 'gérer les candidats', 'gérer les utilisateurs', 'gérer les activités']);
        $superadminRole->givePermissionTo(Permission::all());  // Le superadmin a toutes les permissions
    }
}