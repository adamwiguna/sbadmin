<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::create([
            'slug' => Str::random(20),
            'name' => 'Admin',
            'email' => 'admin',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
            'division_id' => 0,
            'is_admin' => true,
            'authorization_level' => 100,
           ]);
    
    }
}
