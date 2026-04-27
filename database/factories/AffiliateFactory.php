<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Affiliate>
 */
class AffiliateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_conalab' => fake()->unique()->numberBetween(100000, 999999),
            'enrollment_RPA' => fake()->unique()->numberBetween(100000, 999999),
            'sede' => fake()->randomElement(['Potosi', 'La Paz', 'Oruro', 'Santa Cruz', 'Pando', 'Chuquisaca']),
            'profession' => fake()->randomElement(['Abogado', 'Publicista', 'Profesor']),
            'profession_status' => fake()->randomElement(['Libre', 'Funcion publica', 'Privada']),
            'institution' => fake()->domainName(),
            'address_office' => fake()->address(),
            'address_number' => fake()->numberBetween(100, 200),
            'zone' => fake()->address(),
            'address_home' => fake()->address(),
            'address_number_home' => fake()->numberBetween(100, 200),
            'zone_home' => fake()->streetAddress(),
            'sport' => fake()->randomElement(['Tenis', 'Futboll', 'Basquet']),
            'place' => fake()->userName(),
            'date' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'created_at' => fake()->dateTimeBetween('-41 years', '-10 years')->format('Y-m-d'),
            'number' => fake()->unique()->numberBetween(100000, 999999),
            'status' => fake()->randomElement([
                'Activo',
                'Inactivo',
                'Exento',
                'Fallecido',//no
                'Retirada',//no 
                'Licencia'
            ])

        ];
    }
}
