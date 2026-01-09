<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmailcom',
            'password' => bcrypt('password123'),
        ]);
        $admin->roles()->attach(Role::where('name', 'Admin')->first());

        // Create Manager user
        $manager = User::create([
            'name' => 'Manager User',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('password123'),
        ]);
        $manager->roles()->attach(Role::where('name', 'Manager')->first());

        // Create Staff user
        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff1@gmail.com',
            'password' => bcrypt('password123'),
        ]);
        $staff->roles()->attach(Role::where('name', 'Staff')->first());


    }
}
