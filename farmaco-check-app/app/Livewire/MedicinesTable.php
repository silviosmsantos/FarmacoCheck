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
        return DB::table('Medicines');
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
        return [
            Button::add('edit')
                ->slot('Edit: '.$row->id)
                ->id()
                ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
                ->dispatch('edit', ['rowId' => $row->id]),
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
