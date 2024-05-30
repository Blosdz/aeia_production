<?php

namespace Database\Factories;

use App\Models\ClientPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClientPayment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'payment_id' => $this->faker->randomDigitNotNull,
        'referred_code' => $this->faker->word,
        'referred_user_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
