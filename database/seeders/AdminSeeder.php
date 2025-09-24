<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        Admin::create([
            'email' => 'admin@example.com',
            'no_hp' => '0928310213',
            'password' => Hash::make('password123'),
        ]);
    }
}