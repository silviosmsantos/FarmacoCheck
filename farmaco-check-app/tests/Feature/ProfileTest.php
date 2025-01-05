<?php

use App\Models\User;
use Livewire\Volt\Volt;
use Spatie\Permission\Models\Role;

test('profile information can be updated', function () {
    $user = User::factory()->create();
    $role = Role::create(['name' => 'doctor']);

    $user->assignRole('doctor');

    $this->actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $user->refresh();
    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);

    $this->assertAuthenticatedAs($user);
    $this->assertTrue($user->hasRole('doctor'));
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {

    $user = User::factory()->create();
    $role = Role::create(['name' => 'doctor']);
    $user->assignRole('doctor');

    $this->actingAs($user);

    $component = Volt::test('profile.update-profile-information-form')
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation');

    $component
        ->assertHasNoErrors()
        ->assertNoRedirect();

    $this->assertNotNull($user->refresh()->email_verified_at);
    $this->assertTrue($user->hasRole('doctor'));
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser');

    $component
        ->assertHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('profile.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser');

    $component
        ->assertHasErrors('password')
        ->assertNoRedirect();

    $this->assertNotNull($user->fresh());
});
