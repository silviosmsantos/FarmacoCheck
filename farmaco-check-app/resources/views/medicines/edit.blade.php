<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar medicamento
        </h2>
    </x-slot>

    <div class="py-12">
        @if (session('message'))
        <div class="mb-4 max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <x-alert
                title="Medicamento Editado com Sucesso!"
                :message="session('message')"
                positive squared class="bg-green-500 text-white border-green-600 p-4"
                icon="check-circle" />
        </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            
            <livewire:display-id :id="$medicine->id" label="Identificador (ID): " />

                <!-- Formulário de edição -->
                <form action="{{ route('medicines.update', $medicine->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <x-input-label for="name" :value="'Nome'" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $medicine->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="active_ingredient" :value="'Princípio ativo'" />
                        <x-text-input id="active_ingredient" class="block mt-1 w-full" type="text" name="active_ingredient" value="{{ old('active_ingredient', $medicine->active_ingredient) }}" required autocomplete="active_ingredient" />
                        <x-input-error :messages="$errors->get('active_ingredient')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="therapeutic_class" :value="'Classe terapeutica'" />
                        <x-text-input id="therapeutic_class" class="block mt-1 w-full" type="text" name="therapeutic_class" value="{{ old('therapeutic_class', $medicine->therapeutic_class) }}" required autocomplete="therapeutic_class" autocomplete="therapeutic_class" />
                        <x-input-error :messages="$errors->get('therapeutic_class')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="dosage" :value="'Dosagem'" />
                        <x-text-input id="dosage" class="block mt-1 w-full" type="text" name="dosage" value="{{ old('dosage', $medicine->dosage) }}" required autocomplete="dosage" autocomplete="dosage" />
                        <x-input-error :messages="$errors->get('dosage')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="manufacturer" :value="'Fabricante'" />
                        <x-text-input id="manufacturer" class="block mt-1 w-full" type="text" name="manufacturer" value="{{ old('manufacturer', $medicine->manufacturer) }}" required autocomplete="manufacturer" autocomplete="manufacturer" />
                        <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button type="submit" class="ms-4">
                            Atualizar Medicamento
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>