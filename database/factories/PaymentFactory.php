<?php

namespace Database\Factories;

use App\Models\Affiliate;
use App\Models\Fee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['Pagado', 'Por pagar']),
            'date' => fake()->dateTimeBetween('-40 years', '-18 years'),
            'fee_id' => Fee::inRandomOrder()->value('id'),
            'affiliate_id' => Affiliate::inRandomOrder()->value('id')
        ];
    }
}
