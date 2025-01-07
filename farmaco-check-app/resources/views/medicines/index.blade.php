<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Medicamentos
        </h2>
    </x-slot>
        <div class="py-12">
        @if (session('message'))
                <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
                    <x-alert
                        :title="session('message')" 
                        :message="session('message')"
                        positive
                        squared
                        class="bg-green-500 text-white border-green-600 p-4"
                        icon="check-circle"
                    />
                </div>
            @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-2xl font-medium text-gray-700 ">
                        Lista de Medicamentos Cadastrados
                    </h1>
                    @can('create medicines')
                        <strong>
                            <x-button label="Adicionar novo medicamento" icon="plus-circle" :href="route('medicines.create')" solid/>
                        </strong>
                    @endcan
                </div>
                <livewire:medicines-table/>
            </div>
        </div>
    </div>
</x-app-layout>
