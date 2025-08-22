<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Limpar dados da tabela Users
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Models\User::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');


        // Encontrar a role 'DEV'l
        $devRole = Role::where('name', 'DEV')->first();

        // Criar um novo usuário
        User::create([
            'name' => 'Diego Leandro',
            'email' => 'diego@gmail.com',
            'password' => Hash::make('admin123'),    // Use Hash::make() para a senha
            'role_id' => $devRole->id,  // Atribui o ID da role
        ]);

        $devRole = Role::where('name', 'CLIENT')->first();

        // Criar um novo usuário
        User::create([
            'name' => 'Client Junhor',
            'email' => 'client@gmail.com',
            'password' => Hash::make('admin123'),    // Use Hash::make() para a senha
            'role_id' => $devRole->id,  // Atribui o ID da role
        ]);
    }
}
