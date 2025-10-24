<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Jiri;
use App\Models\Project;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Alexandre Briol',
            'email' => 'alexandre.briol@gmail.com',
        ]);
        Jiri::factory()->for($user)->count(10)->create();

         Project::factory()->count(3)->create();
         Contact::factory()->for($user)->count(3)->create();
    }
}
