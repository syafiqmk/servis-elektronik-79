<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DeviceCategory;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password'=> bcrypt('passadmin'),
            'role' => 'admin'
        ]);

        User::factory()->count(25)->create();

        DeviceCategory::factory()->count(25)->create();
    }
}
