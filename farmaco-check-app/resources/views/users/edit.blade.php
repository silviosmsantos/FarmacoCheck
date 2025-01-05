<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Usuário
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('message'))
                <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
                    <x-alert
                        title="Usuário Editado com Sucesso!"
                        :message="session('message')"
                        positive squared class="bg-green-500 text-white border-green-600 p-4"
                        icon="check-circle"
                    />
                </div>
            @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Formulário de edição -->
                <form action="{{ route('users.edit', $user->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT') <!-- Método PUT para atualização -->
                    
                    <div>
                        <x-input-label for="name" :value="'Nome'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="'Email'" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password" :value="'Senha'" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="'Confirmar Senha'" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="'Cargo'" />
                        <select name="role" id="role" class="block mt-1 w-full">
                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                            <option value="superadmin" {{ $user->hasRole('superadmin') ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit" class="ms-4">
                            Atualizar Usuário
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
