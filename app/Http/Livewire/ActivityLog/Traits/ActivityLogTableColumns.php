<?php

namespace App\Http\Livewire\ActivityLog\Traits;

use Rappasoft\LaravelLivewireTables\Views\Column;

trait ActivityLogTableColumns
{
    public $columnSearch = [
        'id' => null,
        'description' => null,
        'causer' => null,
        'subject' => null,
    ];

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'id', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("Action", "description")
                ->searchable()
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'description', 'columnSearch' => $this->columnSearch]);
                }),
            Column::make("Causer")
                ->label(
                    function ($row, Column $column) {
                        if (empty($row->causer)) {
                            return '<span class="text-red-500">Unable to display</span>';
                        } else {
                            return $row->causer->trashed() ? "<span class='line-through cursor-not-allowed text-gray-400'>".$row->causer->name."</span>"
                            : "<a href='".$row->causer->location."' class='underline text-red-500'>".$row->causer->name."</a>";
                        }
                    }
                )
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'causer', 'columnSearch' => $this->columnSearch]);
                })
                ->html(),
            Column::make("Performed On")
                ->label(
                    fn ($row, Column $column) => $row->causer->trashed() ? "<span class='line-through cursor-not-allowed text-gray-400'>".$row->subject->name."</span>"
                      : "<a href='".$row->subject->location."' class='underline text-indigo-500'>".$row->subject->name."</a>"
                )
                ->html()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'subject', 'columnSearch' => $this->columnSearch]);
                })
                ->html(),
            Column::make("Timestamp", "updated_at"),
        ];
    }
}
