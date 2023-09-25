<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@huth.it',
            'email_verified_at' => now(),
            'password' => 'secret'
        ])->forceFill([
            'is_admin' => true,
        ])->save();

        \App\Models\User::factory()->create([
            'name' => 'User',
            'email' => 'user@huth.it',
            'email_verified_at' => now(),
            'password' => 'secret'
        ]);
    }
}
