<?php

namespace App\Http\Livewire\User;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use App\Models\User;

class UserTable extends DataTableComponent
{
    use Traits\UserTableColumns;
    use Traits\UserTableFilters;
    use Traits\UserTableFunctions;

    protected $model = User::class;

    protected $listeners = ['activateSelected', 'deactivateSelected'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringEnabled()
            // ->setFilterLayoutPopover()
            ->setFilterLayoutSlideDown()
            ->setRememberColumnSelectionEnabled()
            ->setDefaultSort('id', 'desc')
            ->setTrAttributes(function ($row, $index) {
                if (!$row->active) {
                    return [
                        'class' => '!bg-red-100 !border-b !border-red-300',
                    ];
                }

                return ['default' => true];
            });
    }

    public function builder(): Builder
    {
        return $this->model::query()
            ->select('deleted_at')
            ->withTrashed()
            ->when($this->columnSearch['id'] ?? null, fn ($query, $id) => $query->where('id', $id))
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%' . $name . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $email) => $query->where('email', 'like', '%' . $email . '%'));
    }
}
