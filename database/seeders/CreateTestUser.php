<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateTestUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@test.com',
            'password' => Hash::make('password123'),
            'no_hp'    => '081234567890',
            'role'     => 'admin'
        ]);

        User::create([
            'name'     => 'Regular User',
            'email'    => 'user@test.com',
            'password' => Hash::make('password123'),
            'no_hp'    => '081234567891',
            'role'     => 'pelanggan'
        ]);
    }
}
