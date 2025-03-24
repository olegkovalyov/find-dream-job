<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class RandomJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Job::factory(10)->create();
        echo 'Jobs created successfully!';
    }
}
