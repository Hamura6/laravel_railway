<?php

namespace Database\Seeders;

use App\Models\Fee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fees = [
            [
                'name' => 'Aportes',
                'amount' => 20,
                'type' => 'single_payment'
            ],
            [
                'name' => 'Inscripcion',
                'amount' => 2000,
                'type' => 'installments'
            ],
            [
                'name' => 'Certificacion',
                'amount' => 400,
                'type' => 'installments'
            ],
            [
                'name' => 'Renovacion',
                'amount' => 1000,
                'type' => 'single_payment'
            ],
            [
                'name' => 'Traspaso',
                'amount' => 100,
                'type' => 'single_payment'
            ]
        ];

        Fee::insert($fees);
    }
}
