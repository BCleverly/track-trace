<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween(now()->subDays(22), now()->addDays(2));
        return [
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'postcode' => $this->faker->postcode,
            'extra_guests' => $this->faker->numberBetween(0, 5),
            'duration_of_stay' => $this->faker->randomElement(
                [
                    '30-minutes',
                    '1-hour',
                    '2-hour',
                    '3-hour',
                    '4-plus',
                    'unsure',
                ]
            ),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
