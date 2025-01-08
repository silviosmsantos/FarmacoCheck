<?php

namespace App\Livewire;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;

final class MedicinesTable extends PowerGridComponent
{
    public string $tableName = 'medicines-table-jt3box-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return DB::table('medicines');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('active_ingredient')
            ->add('therapeutic_class')
            ->add('dosage')
            ->add('manufacturer')
            ->add('crated_at')
            ->add('created_at_format', function ($user) {
                return Carbon::parse($user->created_at)
                    ->timezone('America/Sao_Paulo')
                    ->format('d/m/Y H:i');
            })
            ->add('updated_at')
            ->add('updated_at_format', function ($user) {
                return Carbon::parse($user->updated_at)
                    ->timezone('America/Sao_Paulo')
                    ->format('d/m/Y H:i');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nome', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Princípio ativo', 'active_ingredient')
                ->sortable()
                ->searchable(),

            Column::make('Classe Terapeutica', 'therapeutic_class')
                ->sortable()
                ->searchable(),

            Column::make('Dosagem', 'dosage')
                ->sortable()
                ->searchable(),

            Column::make('Fabricante', 'manufacturer')
                ->sortable()
                ->searchable(),

            Column::make('Adicionado em', 'created_at_format')
                ->sortable(),

            Column::make('Modificado em', 'created_at_format')
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

    public function actions($row): array
    {
        if (auth()->user()->hasRole(['superadmin', 'admin'])) {
            return [
                Button::add('edit')
                    ->slot('<i class="fas fa-edit"></i>Editar')
                    ->id()
                    ->icon('default-edit-icon')
                    ->class('bg-sky-600 hover:bg-sky-800 text-white px-2 py-1 rounded flex items-center')
                    ->tooltip('Clique para editar o registro ID: '.$row->id)
                    ->route('medicines.edit', ['medicine' => $row->id]),

                Button::add('delete')
                    ->slot('<i class="fas fa-trash-alt"></i>Excluir')
                    ->id()
                    ->icon('default-delete-icon')
                    ->class('bg-red-500 hover:bg-red-700 text-white px-2 py-1 rounded flex items-center')
                    ->tooltip('Clique para excluir o registro ID: '.$row->id)
                    ->route('medicines.delete', ['medicine' => $row->id]),
            ];
        }
    }
}
