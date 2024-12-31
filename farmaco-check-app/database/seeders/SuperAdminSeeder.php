<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::factory()->create([
           'name' => 'Silvio Martins Santos',
           'email' => 'silviosmsantos@gmail.com',
           'password' => Hash::make('password'),
       ]);

       $role = Role::firstOrCreate(['name' => 'superadmin']);

       $user->assignRole($role);
    }
}
