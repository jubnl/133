<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ["firstName" => "Gregory", "lastName" => "House", "email" => "g.house@ppth.com", "password" => "salut"],
            ["firstName" => "Lisa", "lastName" => "Cuddy", "email" => "l.cuddy@ppth.com", "password" => "salut"],
            ["firstName" => "Eric", "lastName" => "Foreman", "email" => "e.foreman@ppth.com", "password" => "salut"],
            ["firstName" => "Numéro", "lastName" => "13", "email" => "n.13@ppth.com", "password" => "salut"]
        ];

        foreach ($users as $user) {
            DB::table('users')->insert([
                'first_name' => $user['firstName'],
                'last_name' => $user['lastName'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
