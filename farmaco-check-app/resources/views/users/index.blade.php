<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuários
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-medium text-gray-700 ">
                        Lista de Usuários
                    </h1>
                    @can('manage users')
                        <strong>
                            <x-button label="Adicionar novo usuário" icon="user-plus" :href="route('users.create')"/>
                        </strong>
                    @endcan
                </div>
                <livewire:user-table/>
            </div>
        </div>
    </div>
</x-app-layout>
