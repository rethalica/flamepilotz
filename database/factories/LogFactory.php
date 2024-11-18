<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Log::class;

    public function definition(): array
    {
        return [
            'temperature' => $this->faker->numberBetween(17, 37),
            'water_level' => 100,
            'battery_level' => 100,
            'smoke_level' => $this->faker->numberBetween(0, 25),
            'status' => 'normal',
            'device_id' => Device::inRandomOrder()->first()->id, // take random device_id
        ];
    }
}
