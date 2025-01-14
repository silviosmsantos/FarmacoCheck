<?php

use function Pest\Laravel\actingAs;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
})->skip(true);

test('superadmin user can create users', function () {

    $role = Role::firstOrCreate(['name' => 'superadmin']);
    $permission = Permission::firstOrCreate(['name' => 'manage users']);

    $role->givePermissionTo($permission);
    $superAdmin = User::factory()->create();
    $superAdmin->assignRole($role);


    actingAs($superAdmin)
        ->get('/users/create')
        ->assertStatus(200);

})->skip(true);

test('admin user cannot create users', function () {

    $role = Role::firstOrCreate(['name' => 'admin']);

    $permission = Permission::firstOrCreate(['name' => 'manage users']);

    $admin = User::factory()->create();
    $admin->assignRole($role);

    actingAs($admin)
        ->get('/users/create')
        ->assertStatus(403);

})->skip(true);

test('doctor user cannot view users', function () {

    $role = Role::firstOrCreate(['name' => 'doctor']);

    $doctor = User::factory()->create();
    $doctor->assignRole($role);

    actingAs($doctor)
        ->get('/users')
        ->assertStatus(403);
        
})->skip(true);

test('superadmin user can view users', function () {
    $role = Role::firstOrCreate(['name' => 'superadmin']);
    $permission = Permission::firstOrCreate(['name' => 'view users']);

    $role->givePermissionTo($permission);
    $superAdmin = User::factory()->create();
    $superAdmin->assignRole($role);

    actingAs($superAdmin)
        ->get('/users')
        ->assertStatus(200);
})->skip(true);

test('admin user can view users', function () {
    $role = Role::firstOrCreate(['name' => 'admin']);
    $permission = Permission::firstOrCreate(['name' => 'view users']);

    $role->givePermissionTo($permission);
    $admin = User::factory()->create();
    $admin->assignRole($role);

    actingAs($admin)
        ->get('/users')
        ->assertStatus(200);
})->skip(true);

test('doctor user cannot manage users', function () {
    $role = Role::firstOrCreate(['name' => 'doctor']);
    $doctor = User::factory()->create();
    $doctor->assignRole($role);

    actingAs($doctor)
        ->get('/users/create')
        ->assertStatus(403);

    actingAs($doctor)
        ->get("/users/{$doctor->id}/edit")
        ->assertStatus(403);

    actingAs($doctor)
        ->get("/users/{$doctor->id}/delete")
        ->assertStatus(403);
})->skip(true);