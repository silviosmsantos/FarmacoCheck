<?php

namespace App\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class UserTable extends PowerGridComponent
{
    public string $tableName = 'user-table-yvvil5-table';

    public function setUp(): array
    {
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
            })
            ->add('role', function ($user) {
                $roleName = $user->roles->first()->name ?? 'Sem cargo';
                switch ($roleName) {
                    case 'admin':
                        return 'Administrador';
                    case 'superadmin':
                        return 'SuperAdministrador';
                    case 'doctor':
                        return 'Médico';
                    default:
                        return $roleName; // Caso não haja correspondência, retorna o nome da role
                }
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable()
                ->searchable(),

            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Cargo', 'role'),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('CRM', 'crm')
                ->sortable()
                ->searchable(),

            Column::make('Criado em', 'created_at_format')
                ->sortable(),

            Column::action('Ação'),
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
        $user = auth()->user();

        if ($user->hasRole('superadmin')) {
            return [
                Button::add('edit')
                    ->slot('<i class="fas fa-edit"></i>Editar')
                    ->id()
                    ->icon('default-edit-icon')
                    ->class('bg-sky-600 hover:bg-sky-800 text-white px-2 py-1 rounded flex items-center')
                    ->tooltip('Clique para editar o registro ID: '.$row->id)
                    ->route('users.edit', ['user' => $row->id]),

                Button::add('delete')
                    ->slot('<i class="fas fa-trash-alt"></i>Excluir')
                    ->id()
                    ->icon('default-delete-icon')
                    ->class('bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded flex items-center')
                    ->tooltip('Clique para excluir o registro ID: '.$row->id)
                    ->route('users.delete', ['user' => $row->id]),
            ];
        }

        // adicionar um botão aqui para admins ver infos sobre usuários.
        return [];
    }
}
