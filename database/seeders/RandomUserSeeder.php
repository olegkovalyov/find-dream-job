<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class RandomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        File::deleteDirectory('storage/app/public/avatars');
        File::makeDirectory('storage/app/public/avatars');
        File::copy('resources/images/default-avatar.png', 'storage/app/public/avatars/default-avatar.png');
        User::create([
            'name' => 'Oleh Kovalov',
            'email' => 'tester@test.com',
            'password' => Hash::make('12345678ok'),
        ]);
        User::factory(10)->create();
        echo 'Users created successfully!';
    }
}
