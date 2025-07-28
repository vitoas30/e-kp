<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run the RoleSeeder
        $this->call(RoleSeeder::class);

        // Create an admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);
        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUser->roles()->attach($adminRole);
        }

        // Create a regular user
        $regularUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $userRole = \App\Models\Role::where('name', 'user')->first();
        if ($userRole) {
            $regularUser->roles()->attach($userRole);
        }

        // Create more users if needed
        // User::factory(8)->create()->each(function ($user) use ($userRole) {
        //     if ($userRole) {
        //         $user->roles()->attach($userRole);
        //     }
        // });
    }
}
