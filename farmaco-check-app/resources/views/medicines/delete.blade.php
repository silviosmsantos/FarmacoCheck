<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Excluir Medicamento
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-sm">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('DELETE')

                    <p>Você tem certeza que deseja excluir o medicamento: <strong>{{ $medicine->name }}</strong>? (ID: {{ $medicine->id }})</p>

                    <div class="mt-4">
                        <x-input-label for="confirmation" :value="'Digite o ID do medicamento para confirmar a exclusão'" />
                        <x-text-input id="confirmation" class="block mt-1 w-full" type="text" name="confirmation" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-danger-button type="submit" class="ms-4">
                            Excluir Medicamento
                        </x-danger-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
