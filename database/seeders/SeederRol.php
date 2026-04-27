<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class SeederRol extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Afiliado', 'guard_name' => 'web'],
            ['name' => 'Administrador', 'guard_name' => 'web'],
            ['name' => 'Secretaria', 'guard_name' => 'web'],
            ['name' => 'Director', 'guard_name' => 'web'],
            ['name' => 'Contadora', 'guard_name' => 'web'],
        ];

        Role::insert($roles);
    }
}
