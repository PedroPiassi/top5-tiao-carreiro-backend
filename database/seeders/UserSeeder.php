<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!User::where('email', 'pedro.a.piassi@gmail.com')->first()) {
            $admin = User::create([
                'name' => 'Admin',
                'email' => "admin@gmail.com",
                "password" => Hash::make('123', ["round" => 12]),
                'role' => "admin"
            ]);
        }
    }
}
