<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Nova Interação Medicamentosa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
                <form action="{{ route('interactions.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="medicine_1_id" :value="'Medicamento 1'" />
                        <select id="medicine_1_id" name="medicine_1_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Selecione o primeiro medicamento</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_1_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="medicine_2_id" :value="'Medicamento 2'" />
                        <select id="medicine_2_id" name="medicine_2_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Selecione o segundo medicamento</option>
                            @foreach($medicines as $medicine)
                                <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('medicine_2_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="severity" :value="'Severidade'" />
                        <select id="severity" name="severity" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                            <option value="" disabled selected>Selecione a severidade</option>
                            <option value="grave">Grave</option>
                            <option value="moderada">Moderada</option>
                            <option value="leve">Leve</option>
                        </select>
                        <x-input-error :messages="$errors->get('severity')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="causes" :value="'Causas da Interação'" />
                        <textarea id="causes" name="causes" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="4" placeholder="Descreva as causas da interação" required>{{ old('causes') }}</textarea>
                        <x-input-error :messages="$errors->get('causes')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="source" :value="'Fonte do Estudo'" />
                        <x-text-input id="source" class="block mt-1 w-full" type="url" name="source" value="{{ old('source') }}" placeholder="http://exemplo.com" required />
                        <x-input-error :messages="$errors->get('source')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit" class="ms-4">
                            Adicionar Interação
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
