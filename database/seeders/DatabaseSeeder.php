<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@trustedgeinfotech.com'],
            [
                'name' => 'TrustEdge Admin',
                'company' => 'TrustEdge Infotech',
                'phone' => '+91 90000 00000',
                'role' => 'admin',
                'password' => 'password',
            ]
        );
    }
}
