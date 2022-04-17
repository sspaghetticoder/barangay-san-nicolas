<?php

namespace App\Http\Livewire\Resident;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ResidentTable extends DataTableComponent
{
    use Traits\ResidentTableColumns;
    use Traits\ResidentTableFilters;

    protected $model = Resident::class;

    public function configure(): void
    {
        $this->setPrimaryKey('full_id')
            ->setQueryStringEnabled()
            // ->setFilterLayoutPopover()
            ->setFilterLayoutSlideDown()
            ->setRememberColumnSelectionEnabled()
            ->setDefaultSort('id', 'desc');
    }

    public function builder(): Builder
    {
        return $this->model::query()
            ->select('deleted_at')
            ->withTrashed()
            ->when($this->columnSearch['full_id'] ?? null, fn ($query, $fullId) => $query->where('full_id', $fullId))
            ->when($this->columnSearch['last_name'] ?? null, fn ($query, $lastName) => $query->where('last_name', 'like', '%' . $lastName . '%'))
            ->when($this->columnSearch['first_name'] ?? null, fn ($query, $firstName) => $query->where('first_name', 'like', '%' . $firstName . '%'))
            ->when($this->columnSearch['middle_name'] ?? null, fn ($query, $middleName) => $query->where('middle_name', 'like', '%' . $middleName . '%'))
            ->when($this->columnSearch['suffix'] ?? null, fn ($query, $suffix) => $query->where('suffix', 'like', '%' . $suffix . '%'));
    }
}
