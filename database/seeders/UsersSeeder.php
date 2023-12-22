<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // for debugging case
        User::create([
            "name"=> "Funso",
            "email"=> "seunfamil@gmail.com",
            "password"=> Hash::make("12345678"),
        ]);
        User::create([
            "name"=> "Pamela",
            "email"=> "pamela@gmail.com",
            "password"=> Hash::make("12345678"),
            "role_id" => "2",
        ]);
        User::create([
            "name"=> "Seyi",
            "email"=> "seyi@gmail.com",
            "password"=> Hash::make("12345678"),
            "role_id" => "3",
        ]);
    }
}
