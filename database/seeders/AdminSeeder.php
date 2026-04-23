<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@iemcollection.com'],
            [
                'name'     => 'Admin IEM',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        $this->command->info('Admin akun berhasil dibuat!');
        $this->command->info('Email   : admin@iemcollection.com');
        $this->command->info('Password: admin123');
    }
}