<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'location' => $this->faker->city(),
            'description' => $this->faker->text(500),
            'capacity' => $this->faker->numberBetween(10, 100),
            'operation_time' => [
                'Senin' => ['06:00', '18:00'],
                'Selasa' => ['06:00', '18:00'],
                'Rabu' => ['06:00', '18:00'],
                'Kamis' => ['06:00', '18:00'],
                'Jumat' => ['06:00', '18:00'],
            ],
            'status' => Place::STATUS_OPEN,
            'ticket_price' => 35000,
        ];
    }
}
