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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        $this->call([
            MedicineSeeder::class,
        ]);

        $this->call([
            InteractionSeeder::class,
        ]);

        User::factory()
            ->count(15)
            ->create()
            ->each(function ($user) {
                $user->assignRole('doctor');
            });

        User::factory()
            ->count(2)
            ->create()
            ->each(function ($user) {
                $user->assignRole('admin');
            });

        User::factory()
            ->count(2)
            ->create()
            ->each(function ($user) {
                $user->assignRole('superadmin');
            });
    }
}
