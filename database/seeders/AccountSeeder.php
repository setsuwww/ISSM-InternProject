<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AccountSeeder extends Seeder
{
    public function run(): void
    {

        User::create([
            'name' => 'Admin 1',
            'nik' => '000000000001',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'akses_role' => 'Admin',
        ]);

        User::create([
            'name' => 'Operator 1',
            'nik' => '000000000002',
            'email' => 'operator@example.com',
            'password' => Hash::make('password'),
            'akses_role' => 'Operator',
        ]);

        User::create([
            'name' => 'Mursidi',
            'nik' => '000000000003',
            'email' => 'murmur@example.com',
            'password' => Hash::make('password'),
            'akses_role' => 'User',
        ]);
        User::create([
            'name' => 'Dirman',
            'nik' => '000000000004',
            'email' => 'dir@example.com',
            'password' => Hash::make('password'),
            'akses_role' => 'User',
        ]);
    }
}
