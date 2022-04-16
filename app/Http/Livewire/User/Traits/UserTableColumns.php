<?php

namespace App\Http\Livewire\User\Traits;

use Illuminate\Support\Facades\Gate;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

trait UserTableColumns
{
    public $columnSearch = [
        'id' => null,
        'name' => null,
        'email' => null,
    ];

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'id', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'name', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("Email", "email")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'email', 'columnSearch' => $this->columnSearch]);
                }),
            BooleanColumn::make('Active', 'active'),
            Column::make($this->model::updatedAtAlias(), "updated_at"),
            Column::make("Action")
                ->label(function ($row, Column $column) {
                    return view('tables.cells.action-buttons', $row->trashed()
                        ? ['undoLink' => route('users.undo', $row)] : array_merge(
                            [
                                'viewLink' => route('users.show', $row),
                                'editLink' => route('users.edit', $row),
                            ],
                            Gate::forUser(auth()->user())->allows('delete-user', $row) ? ['deleteLink' => route('users.destroy', $row)] : []
                        ));
                })
                ->html(),
        ];
    }
}
