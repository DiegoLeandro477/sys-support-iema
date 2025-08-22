<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Role::create(['name' => 'DEV']);
        Role::create(['name' => 'CLIENT']);
    }
}
