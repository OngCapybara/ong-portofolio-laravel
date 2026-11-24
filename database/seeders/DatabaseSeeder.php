<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@demo.com'],
            [
                'name' => 'Ong Azis Saliem (Admin)',
                'password' => Hash::make('password123'),
            ]
        );

        // Panggil seeder portofolio yang sudah ada sebelumnya
        $this->call([
            PortfolioSeeder::class,
        ]);
    }
}
