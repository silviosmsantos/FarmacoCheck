<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $crm = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'crm' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
    
        if ($this->crmContainsFirstFivePrimes($validated['crm'])) {
            $user->assignRole('superadmin');
        } else {
            $user->assignRole('doctor');
        }
    
        event(new Registered($user));
    
        Auth::login($user);
    
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
    
    /**
     * Verifica se o CRM contém os seis primeiros números primos (2, 3, 5, 7, 11, 13).
     *
     * @param string $crm
     * @return bool
     */
    private function crmContainsFirstFivePrimes(string $crm): bool
    {
        $firstPrimes = ['2', '3', '5', '7', '11', '13'];
    
        foreach ($firstPrimes as $prime) {
            if (!str_contains($crm, $prime)) {
                return false;
            }
        }
    
        return true;
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="'Nome'" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- CRM -->
        <div class="mt-4">
            <x-input-label for="crm" :value="'CRM'" />

            <x-text-input wire:model="crm" id="crm" class="block mt-1 w-full"
                type="text"
                name="crm"
                required />

            <x-input-error :messages="$errors->get('crm')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="'Senha'" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                Já está registrado?
            </a>

            <x-primary-button class="ms-4">
                Registrar-se
            </x-primary-button>
        </div>
    </form>
</div>