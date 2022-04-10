<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Models\User;
use Carbon\Carbon;

class UserTable extends DataTableComponent
{
    public $columnSearch = [
        'name' => null,
        'email' => null,
    ];

    public array $bulkActions = [
        'activateSelected' => 'Activate',
        'deactivateSelected' => 'Deactivate',
    ];

    public bool $columnSelect = true;

    public function boot()
    {
        $this->queryString['columnSearch'] = ['except' => null];
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable()
                ->selected(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable()
                ->asHtml()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'name', 'columnSearch' => $this->columnSearch]);
                })
                ->selected(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable()
                ->asHtml()
                ->secondaryHeader(function () {
                    return view('tables.cells.input-search', ['field' => 'email', 'columnSearch' => $this->columnSearch]);
                })
                ->selected(),
            Column::make('Active')
                ->sortable()
                ->asHtml()
                ->format(function ($value) {
                    return view('tables.cells.active-icon', ['active' => $value]);
                })
                ->selected(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->selected(),
            Column::make("Updated at", "updated_at")
                ->sortable()
                ->selected(),
        ];
    }

    public function setTableRowClass($row): ?string
    {
        return $row->active ? null : '!bg-red-100 !border-b !border-red-300';
    }

    public function filters(): array
    {
        return [
            'active' => Filter::make('Active')
                ->select([
                    '' => 'Any',
                    1 => 'Yes',
                    0 => 'No',
                ]),
            'dateCreatedFrom' => Filter::make('Created From')
                ->date(),
            'dateCreatedTo' => Filter::make('Created To')
                ->date(),
        ];
    }

    public function query(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('email', 'like', '%' . $email . '%'))
            ->when($this->hasFilter('active'), fn ($query) => $query->where('active', $this->getFilter('active') ?? 0))
            ->when($this->getFilter('dateCreatedFrom'), fn ($query, $date) => $query->whereDate('created_at', '>=', Carbon::parse($date)->format('Y-m-d')))
            ->when($this->getFilter('dateCreatedTo'), fn ($query, $date) => $query->whereDate('created_at', '<=', Carbon::parse($date)->format('Y-m-d')));
    }

    public function activateSelected()
    {
        if (count($this->selectedKeys)) {
            User::whereIn('id', $this->selectedKeys)->where('active', 0)->update(['active' => true]);
        }
    }

    public function deactivateSelected()
    {
        if (count($this->selectedKeys)) {
            User::whereIn('id', $this->selectedKeys)->where('active', 1)->update(['active' => false]);
        }
    }
}
