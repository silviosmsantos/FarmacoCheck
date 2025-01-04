<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'user-table-yvvil5-table';

    public function setUp(): array
    {
        $this->showCheckBox();
        return [
            PowerGrid::header()
                ->showSearchInput()
                ->showToggleColumns(), 
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('email')
            ->add('crm')
            ->add('crated_at')
            ->add('created_at_format', function ($user) {
                return Carbon::parse($user->created_at)->format('d/m/Y H:i');
            }); 
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('CRM', 'crm')
                ->sortable()
                ->searchable(),

            //Column::make('Tipo', )

            Column::make('Criado em', 'created_at_format')
                ->sortable(),

            Column::action('Ação')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(User $row): array
    {
        return [
            Button::add('edit')
                ->slot('<i class="fas fa-edit"></i>Editar')
                ->id()
                ->icon('default-edit-icon')
                ->class('bg-sky-600 hover:bg-sky-800 text-white px-2 py-1 rounded flex items-center')
                ->tooltip('Clique para editar o registro ID: ' . $row->id)
                ->dispatch('edit', ['rowId' => $row->id]),

            Button::add('delete')
                ->slot('<i class="fas fa-trash-alt"></i>Excluir')
                ->id()
                ->icon('default-delete-icon')
                ->class('bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded flex items-center')
                ->tooltip('Clique para excluir o registro ID: ' . $row->id)
                ->dispatch('delete', ['rowId' => $row->id]),
                ];
    }

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
