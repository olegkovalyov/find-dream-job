<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RandomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        echo 'Users created successfully!';
    }
}
