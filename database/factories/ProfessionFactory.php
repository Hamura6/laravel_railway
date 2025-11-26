<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\Specialty;
use App\Models\University;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profession>
 */
class ProfessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area' => fake()->randomElement([
                'Legal',
                'Recursos Humanos',
                'Finanzas',
                'Contabilidad',
                'Administración',
                'Litigios',
                'Contratos',
                'Proyectos',
                'Comercial',
                'Marketing',
                'TI',
                'Penal',
                'Civil',
                'Laboral',
                'Internacional',
            ]),
            'date' => fake()->dateTimeBetween('-40 years', '-18 years')->format('Y-m-d'),
            'affiliate_id' => Affiliate::inRandomOrder()->value('id'),
            'university_id' => University::inRandomOrder()->value('id'),
            'specialty_id' => Specialty::inRandomOrder()->value('id')
        ];
    }
}
