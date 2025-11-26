<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederSpecialty extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specialties = [
            ['name' => 'Derecho Civil'],
            ['name' => 'Derecho Penal'],
            ['name' => 'Derecho Laboral'],
            ['name' => 'Derecho Constitucional'],
            ['name' => 'Derecho Agrario']
        ];
        Specialty::insert($specialties);
    }
}
