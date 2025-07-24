<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'An Phu',
            'email' => 'ducvu.nuce60@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('892601997'),
            'avatar' => null,
            'level' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(1)->create();
    }
}
