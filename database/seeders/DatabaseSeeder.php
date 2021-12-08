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
        \App\Models\User::create([
            'slug' => Str::random(20),
            'name' => 'Admin',
            'email' => 'user1',
            'email_verified_at' => now(),
            'password' => bcrypt('1234'),
            'remember_token' => Str::random(10),
            'division_id' => 0,
            'is_admin' => false,
            'authorization_level' => 1,
        ]);
        \App\Models\Division::create([
            'nama' => 'Dinas A',
            'singkatan' => 'DinA',
        ]);
        \App\Models\Division::create([
            'nama' => 'Dinas B',
            'singkatan' => 'DinB',
        ]);
        \App\Models\Division::create([
            'nama' => 'Dinas C',
            'singkatan' => 'DinC',
        ]);
    
    }
}
