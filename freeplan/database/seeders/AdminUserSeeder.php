<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kas.local'],
            [
                'name' => 'Admin KAS',
                'fullname' => 'Administrateur KAS',
                'password' => Hash::make('Admin@123456'),
                'role' => 'ADMIN',
                'email_verified_at' => now(),
            ]
        );
    }
}
