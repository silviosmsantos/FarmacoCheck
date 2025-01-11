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
                        <x-button secondary label="Adicionar uma nova interação" icon="plus" :href="route('interactions.create')" />
                    </strong>
                    @endcan
                </div>

                @foreach($interactions as $interaction)
                <div class="relative flex flex-col my-6 bg-white shadow-lg border border-slate-300 rounded-lg w-full">
                    
                    <div class="mx-3 mb-4 border-b border-slate-200 pt-3 pb-2 px-1">
                        <span class="text-sm text-slate-600 font-medium">
                            Interação entre:
                        </span>
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl text-slate-600 font-bold uppercase">
                                {{ $interaction->medicines1->name }}
                            </span>
                            <span class="text-xl text-slate-500 font-medium">|</span>
                            <span class="text-2xl text-slate-600 font-bold uppercase">
                                {{ $interaction->medicines2->name }}
                            </span>
                        </div>
                    </div>

                    <div class="p-4">
                        <h5 class="mb-1 text-slate-800 text-lg font-semibold uppercase">
                            Gravidade:
                            <span class="font-bold {{ 
                    $interaction->severity == 'grave' ? 'text-red-600' :
                    ($interaction->severity == 'moderada' ? 'text-yellow-600' : 'text-green-600') }}">
                                {{ ucfirst($interaction->severity) }}
                            </span>
                        </h5>

                        <p class="text-slate-600 leading-normal font-light pt-4">
                            <strong class="font-bold">Causas:</strong> {{ $interaction->causes }}
                        </p>
                        <p class="text-slate-600 leading-normal font-light pt-4">
                            <strong class="font-bold">Fonte:</strong> {{ $interaction->source }}
                        </p>

                        <div class="border-t border-slate-200 my-4"></div>

                        @can(['edit interactions', 'delete interactions'])
                        <div class="flex justify-end space-x-4">
                            <x-button sm interaction:solid outline gray label="Editar" icon="pencil"
                                :href="route('interactions.edit', $interaction->id)" />
                            <x-button sm interaction="negative" label="Excluir" icon="trash" class="bg-red-600"
                                :href="route('interactions.delete', $interaction->id)" />
                        </div>
                        @endcan
                    </div>
                    
                </div>
                @endforeach
                <div class="mt-6">
                    {{ $interactions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
