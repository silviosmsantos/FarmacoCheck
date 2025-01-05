<?php

use Livewire\Volt\Volt;
use Spatie\Permission\Models\Role;

test('new users can register', function () {

    Role::create(['name' => 'doctor', 'guard_name' => 'web']);
    Role::create(['name' => 'superadmin', 'guard_name' => 'web']);

    $component = Volt::test('pages.auth.register')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('password', 'password')
        ->set('crm', '12345') // Substitua por um CRM válido
        ->set('password_confirmation', 'password');

    $component->call('register');

    $component->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});
