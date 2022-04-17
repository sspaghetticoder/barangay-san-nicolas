<?php

namespace App\Http\Livewire\Resident\Traits;

use Rappasoft\LaravelLivewireTables\Views\Column;
use Carbon\Carbon;

trait ResidentTableColumns
{
    public $columnSearch = [
        'full_id' => null,
        'last_name' => null,
        'first_name' => null,
        'middle_name' => null,
        'suffix' => null,
    ];

    public function columns(): array
    {
        return [
            Column::make("Resident ID", "full_id")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'full_id', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make('Full Name', 'name')
                ->searchable()
                ->excludeFromColumnSelect()
                ->hideIf(true),
            Column::make("Last name", "last_name")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'last_name', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("First name", "first_name")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'first_name', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("Middle name", "middle_name")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'middle_name', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("Suffix", "suffix")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'suffix', 'columnSearch' => $this->columnSearch]);
                }),
            // Column::make($this->model::updatedAtAlias(), "updated_at"),
            Column::make("Action")
                ->label(function ($row, Column $column) {
                    return view('tables.cells.action-buttons', $row->trashed() ? ['undoLink' => route('residents.undo', $row->full_id)] : [
                        'viewLink' => route('residents.show', $row->full_id),
                        'editLink' => route('residents.edit', $row->full_id),
                        'deleteLink' => route('residents.destroy', $row->full_id),
                    ]);
                })
                ->html(),
        ];
    }
}
