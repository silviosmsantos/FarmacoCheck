<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Adicionar Novo Medicamento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
                <form action="{{ route('medicines.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="name" :value="'Nome'" />
                        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" placeholder="ex: Enalapril" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="active_ingredient" :value="'Princípio Ativo'" />
                        <x-text-input wire:model="active_ingredient" id="active_ingredient" class="block mt-1 w-full" type="text" name="active_ingredient" value="{{ old('active_ingredient') }}" placeholder="ex: Enalapril maleato" required autocomplete="active_ingredient" />
                        <x-input-error :messages="$errors->get('active_ingredient')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="therapeutic_class" :value="'Classe Terapêutica'" />
                        <x-text-input wire:model="therapeutic_class" id="therapeutic_class" class="block mt-1 w-full" type="text" name="therapeutic_class" value="{{ old('therapeutic_class') }}" placeholder="ex:  Inibidor da Enzima Conversora de Angiotensina (IECA)" required autocomplete="therapeutic_class" />
                        <x-input-error :messages="$errors->get('therapeutic_class')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="dosage" :value="'Dosagem'" />
                        <x-text-input wire:model="dosage" id="dosage" class="block mt-1 w-full" type="text" name="dosage" value="{{ old('dosage') }}" placeholder="ex: 40mg" required autocomplete="dosage" />
                        <x-input-error :messages="$errors->get('dosage')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="manufacturer" :value="'Fabricante'" />
                        <x-text-input wire:model="manufacturer" id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" value="{{ old('manufacturer') }}" placeholder="ex: Merck" required autocomplete="manufacturer" />
                        <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit" class="ms-4">
                            Adicionar Medicamento
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
