<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Interações
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
                    <h1 class="text-2xl font-medium text-gray-700">
                        Lista de Interações Entre Medicamentos
                    </h1>

                    @can('create interactions')
                        <strong>
                            <x-button secondary label="Adicionar uma nova interação" icon="plus" :href="route('medicines.create')" />
                        </strong>
                    @endcan
                </div>

                <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full">
                    @foreach($interactions as $interaction)
                        <div class="mx-3 mb-4 border-b border-slate-200 pt-3 pb-2 px-1">
                            <span class="text-sm text-slate-600 font-medium">
                                Interação entre: {{ $interaction->medicines1->name }} e {{ $interaction->medicines2->name }}
                            </span>
                        </div>

                        <div class="p-4">
                            <h5 class="mb-2 text-slate-800 text-xl font-semibold">
                                Gravidade: {{ ucfirst($interaction->severity) }}
                            </h5>
                            <p class="text-slate-600 leading-normal font-light">
                                Causas: {{ $interaction->causes }}
                            </p>
                            <p class="text-slate-600 leading-normal font-light">
                                Fonte: {{ $interaction->source }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
