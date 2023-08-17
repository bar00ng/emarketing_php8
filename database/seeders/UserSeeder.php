<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'admin',
            'last_name' => null,
            'alamat_lengkap' => null,
            'no_telp' => null,
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ])->addRole('admin');

        User::create([
            'first_name' => 'user',
            'last_name' => null,
            'alamat_lengkap' => null,
            'no_telp' => null,
            'username' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123')
        ])->addRole('user');
    }
}
