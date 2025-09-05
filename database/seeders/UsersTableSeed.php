<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Ticket;
use App\Models\TicketDev;
use App\Models\User;
use App\Models\UserClient;
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

        // // Limpar as tabelas antes de popular para enviar
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        TicketDev::truncate();
        Ticket::truncate();
        UserClient::truncate();
        User::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Pega os papéis (roles) para associar aos usuários
        $devRole = Role::where('name', 'DEV')->first();
        $clientRole = Role::where('name', 'CLIENT')->first();

        // Criar um novo usuário
        $admin = User::create([
            'name' => 'Admin Master',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),    // Use Hash::make() para a senha
            'role_id' => $devRole->id,  // Atribui o ID da role
        ]);

        UserClient::create([
            'user_id' => $admin->id,
            'unidade' => 'CTI',
            'number_phone' => '(98) 99999-9999'
        ]);


        // Criar um novo usuário
        $client = User::create([
            'name' => 'Client Junhor',
            'email' => 'client@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => $clientRole->id,  // Atribui o ID da role
        ]);

        // UserClient::create([
        //     'user_id' => $client->id,
        // ]);
    }
}
