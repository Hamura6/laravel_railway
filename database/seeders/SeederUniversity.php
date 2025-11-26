<?php

namespace Database\Seeders;

use App\Models\University;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeederUniversity extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = [
            [
                'name' => 'Universidad Autonoma Tomas Frias',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Mayor De San Francisto Xavier De Chuquisaca',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Boliviana Juan Misael Saracho',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Tecnica De Oruro',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Mayor Y Autonoma Juan Misael Saracho',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Boliviana Gabriel Rene Moreno',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Mayor De San Andres',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Mayor De San Simon',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Contemporanea',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Catolica Boliviana San Pablo',
                'entity' => 'Privada'
            ],
            [
                'name' => 'Universidad De Aquino',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Tecnica Privada Cosmos',
                'entity' => 'Privada'
            ],
            [
                'name' => 'Universidad Nacional Siglo Xx',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Privada Del Valle',
                'entity' => 'Privada'
            ],
            [
                'name' => 'Universidad Salesiana De Bolivia',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad San Francisco De Asis',
                'entity' => 'Privada'
            ],
            [
                'name' => 'Universidad Privada De Oruro',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Boliviana De Informatica',
                'entity' => 'Publica'
            ],
            [
                'name' => 'Universidad Privada Domingo Savio',
                'entity' => 'Privada'
            ],
            [
                'name' => 'Universidad Privada Simon Patiño',
                'entity' => 'Privada'
            ]
        ];

        University::insert($universities);
    }
}
