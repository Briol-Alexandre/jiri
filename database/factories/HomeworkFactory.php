<?php

namespace Database\Factories;

use App\Models\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HomeworkFactory extends Factory
{
    protected $model = Assignment::class;

    public function definition(): array
    {
        return [
            'jiri_id' => $this->faker->randomNumber(),
            'project_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
