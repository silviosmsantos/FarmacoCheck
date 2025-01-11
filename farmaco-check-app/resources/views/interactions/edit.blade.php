<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Interação
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('message'))
        <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <x-alert
                title="session('message')"
                :message="session('message')"
                positive squared class="bg-green-500 text-white border-green-600 p-4"
                icon="check-circle" />
        </div>
        @endif
        
        @if ($errors->any())
        <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <x-alert
                title="Erro(s) Encontrado(s)!"
                :message="'Por favor, corrija os seguintes erros:'"
                negative
                class="bg-red-100 border-red-400 text-red-700">
                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </x-alert>
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <livewire:display-id :id="$interaction->id" label="Interação de Identificador (ID): " />

                <!-- Formulário de edição -->
                <form action="{{ route('interactions.update', $interaction->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="medicine_1_id" :value="'Medicamento 1'" />
                        <select id="medicine_1_id" name="medicine_1_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled>Selecione o primeiro medicamento</option>
                            @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ $interaction->medicine_1_id == $medicine->id ? 'selected' : '' }}>
                                {{ $medicine->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_1_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="medicine_2_id" :value="'Medicamento 2'" />
                        <select id="medicine_2_id" name="medicine_2_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled>Selecione o segundo medicamento</option>
                            @foreach($medicines as $medicine)
                            <option value="{{ $medicine->id }}" {{ $interaction->medicine_2_id == $medicine->id ? 'selected' : '' }}>
                                {{ $medicine->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_2_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="severity" :value="'Severidade'" />
                        <select id="severity" name="severity" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled>Selecione a severidade</option>
                            <option value="grave" {{ $interaction->severity == 'grave' ? 'selected' : '' }}>Grave</option>
                            <option value="moderada" {{ $interaction->severity == 'moderada' ? 'selected' : '' }}>Moderada</option>
                            <option value="leve" {{ $interaction->severity == 'leve' ? 'selected' : '' }}>Leve</option>
                        </select>
                        <x-input-error :messages="$errors->get('severity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="causes" :value="'Causas da Interação'" />
                        <textarea id="causes" name="causes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" required>{{ old('causes', $interaction->causes) }}</textarea>
                        <x-input-error :messages="$errors->get('causes')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="source" :value="'Fonte do Estudo'" />
                        <x-text-input id="source" class="block mt-1 w-full" type="url" name="source" value="{{ old('source', $interaction->source) }}" required />
                        <x-input-error :messages="$errors->get('source')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit" class="ms-4">
                            Atualizar Interação
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>