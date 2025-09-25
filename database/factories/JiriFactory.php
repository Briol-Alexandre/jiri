<?php

namespace Database\Factories;

use App\Models\Jiri;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JiriFactory extends Factory
{
    protected $model = Jiri::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(2),
            'date' => Carbon::now()->format('Y-m-d H:i:s'),
            'description' => $this->faker->text(50) || null,
        ];
    }

    public function withoutName()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => null,
            ];
        });
    }

    public function withoutDate()
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => null,
            ];
        });
    }

    public function withInvalidDate()
    {
        return $this->state(function (array $attributes) {
            return [
                'date' => 'toto',
            ];
        });
    }
}
