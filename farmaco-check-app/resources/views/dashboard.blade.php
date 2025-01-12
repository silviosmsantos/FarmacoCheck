<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Consultas de Interações
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Consultar Interação Medicamentosa</h3>

                    <!-- Texto introdutório -->
                    <p class="mb-6 text-gray-700 border-slate-500 border-l-4 p-3 ">
                        Esta aplicação foi desenvolvida para auxiliar profissionais da área da saúde na identificação de interações entre medicamentos.
                        Insira os nomes dos dois medicamentos que deseja analisar para verificar se há interações conhecidas, sua gravidade e as possíveis causas.
                    </p>

                    <!-- Formulário -->
                    <form action="{{ route('interactions.search') }}" method="GET" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="medicine1" :value="'Medicamento A'" />
                            <x-text-input id="medicine1" name="medicine1" type="text" class="block mt-1 w-full" required />
                        </div>

                        <div>
                            <x-input-label for="medicine2" :value="'Medicamento B'" />
                            <x-text-input id="medicine2" name="medicine2" type="text" class="block mt-1 w-full" required />
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <x-primary-button>
                                Buscar Interação
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Resultado da Interação -->
                    @isset($interaction)
                    <div class="relative flex flex-col my-6 bg-white shadow-sm border border-slate-200 rounded-lg w-full mx-auto">
                        <div class="mx-3 mb-0 border-b border-slate-200 pt-3 pb-2 px-1">
                            <span class="text-sm font-medium text-slate-600">
                                Resultado da Interação
                            </span>
                        </div>

                        <div class="p-4">
                            <h5 class="mb-7 text-slate-800 text-xl font-semibold">
                                {{ $interaction->medicines1->name }} <span class="font-light">e</span> {{ $interaction->medicines2->name }}
                            </h5>

                            <!-- Informações dos medicamentos com grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Medicamento 1 -->
                                <div class="p-2">
                                    <h6 class="font-bold text-xl mb-4 text-emerald-700">{{ $interaction->medicines1->name }}</h6>
                                    <p class="mb-1"><span class="font-semibold">Princípio Ativo:</span> {{ $interaction->medicines1->active_ingredient }}</p>
                                    <p class="mb-1"><span class="font-semibold">Classe Terapêutica:</span> {{ $interaction->medicines1->therapeutic_class }}</p>
                                    <p class="mb-1"><span class="font-semibold">Dosagem:</span> {{ $interaction->medicines1->dosage }}</p>
                                    <p class="mb-1"><span class="font-semibold">Fabricante:</span> {{ $interaction->medicines1->manufacturer }}</p>
                                </div>

                                <!-- Medicamento 2 -->
                                <div class="p-2">
                                    <h6 class="font-bold text-xl mb-4 text-emerald-700">{{ $interaction->medicines2->name }}</h6>
                                    <p class="mb-1"><span class="font-semibold">Princípio Ativo:</span> {{ $interaction->medicines2->active_ingredient }}</p>
                                    <p class="mb-1"><span class="font-semibold">Classe Terapêutica:</span> {{ $interaction->medicines2->therapeutic_class }}</p>
                                    <p class="mb-1"><span class="font-semibold">Dosagem:</span> {{ $interaction->medicines2->dosage }}</p>
                                    <p class="mb-1"><span class="font-semibold">Fabricante:</span> {{ $interaction->medicines2->manufacturer }}</p>
                                </div>
                            </div>


                            <!-- Informações da interação -->
                            <div class="mt-4">
                                <h6 class="font-bold mb-2 text-slate-700 uppercase">Interação</h6>
                                <p class="mb-2">
                                    <span class="font-semibold">Gravidade:</span>
                                    <span class="font-bold uppercase 
                                        {{ 
                                            $interaction->severity == 'grave' ? 'text-red-600' : 
                                            ($interaction->severity == 'moderada' ? 'text-yellow-600' : 'text-green-600') 
                                        }}">
                                        {{ ucfirst($interaction->severity) }}
                                    </span>
                                </p>
                                <p class="mb-2"><span class="font-semibold">Causas:</span> {{ $interaction->causes }}</p>
                            </div>
                        </div>

                        <div class="mx-3 border-t border-slate-200 pb-3 pt-2 px-1">
                            <span class="text-sm text-slate-600 font-medium">
                                Fonte: {{ $interaction->source }}
                            </span>
                            <div class="flex justify-end">
                                <x-button icon="arrow-path"
                                    secondary
                                    class="font-semibold uppercase tracking-widest shadow-sm text-xs"
                                    href="{{ route('interactions.reset') }}">
                                    RESETAR BUSCA
                                </x-button>
                            </div>
                        </div>
                    </div>
                    @endisset

                    @if(session('message'))
                    <div class="mt-6 p-4 bg-red-100 border border-red-400 text-red-800 rounded">
                        {{ session('message') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>