<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Crypto>
 */
class CryptoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'symbol' => $this->faker->word,
            'avg_price' => $this->faker->randomFloat(2, 0, 100),
            'total_coin' => $this->faker->randomFloat(2, 0, 100),
            'total_usdt' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
