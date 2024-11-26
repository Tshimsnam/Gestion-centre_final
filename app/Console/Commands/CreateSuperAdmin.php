<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class CreateSuperAdmin extends Command
{
    protected $signature = 'make:superadmin {name} {email} {password}';
    protected $description = 'Créer un super admin';

    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = bcrypt($this->argument('password'));


        // Créer l'utilisateur
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,

        ]);

        // Vérifier si le rôle superadmin existe, sinon le créer
        $role = Role::firstOrCreate(['name' => 'superadmin']);

        // Associer le rôle à l'utilisateur
        $user->roles()->attach($role->id);

        $this->info("Super admin créé : {$user->name} ({$user->email}) ");
    }
}