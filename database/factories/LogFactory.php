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
            'temperature' => $this->faker->numberBetween(17, 40), // Nilai antara 17 - 40 derajat
            'water_level' => 100, // Nilai statis 100
            'battery_level' => 100, // Nilai statis 100
            'smoke_level' => $this->faker->numberBetween(0, 30), // Nilai antara 0 - 30
            'status' => 'normal', // Nilai statis 'normal'
            'device_id' => Device::inRandomOrder()->first()->id, // Mengambil device_id secara acak
        ];
    }
}
