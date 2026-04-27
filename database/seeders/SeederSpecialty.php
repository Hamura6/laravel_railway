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
            ['name' => "Maestria en Derecho Penal y Procesal Penal"],
            ['name' => "Diplomado Procesal Penal"],
            ['name' => "Diplomado en Derecho Penal y procesal Penal"],
            ['name' => "Diplomadoen Educacion Superior"],
            ['name' => "Diplomado en Gestión INTEGRAL DE Contrataciones Estatales de Bienes y Servicios"],
            ['name' => "Maestria en Derecho Civil y Procesal Civil"],
            ['name' => "Derecho Notarial"],
            ['name' => "Diplomado en Ciencias Penales"],
            ['name' => "Diplomado en Derecho Procesal Civil"],
            ['name' => "Diplomado en educación Superior"],
            ['name' => "Diplomado en Derecho constitucional"],
            ['name' => "Diplomado en Educación Superior Basado en Competencias"],
            ['name' => "Diplomado en Derecho Procesal Constitucional"],
            ['name' => "Diplomado en docenccia Universitaria basada en la formación por competencias"],
            ['name' => "Diplomado en Derecho Constitucional y Derechos Humanos"],
            ['name' => "Derecho Procesal Constitucional"]
        ];
        Specialty::insert($specialties);
    }
}
