<?php

namespace App\Http\Livewire\ActivityLog;

use App\Http\Livewire\ActivityLog\Traits\ActivityLogTableColumns;
use App\Http\Livewire\ActivityLog\Traits\ActivityLogTableFilters;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ActivityLogTable extends DataTableComponent
{
    use ActivityLogTableColumns;
    use ActivityLogTableFilters;

    protected $model = Activity::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setQueryStringEnabled()
            // ->setFilterLayoutPopover()
            ->setFilterLayoutSlideDown()
            ->setDefaultSort('id', 'desc')
            ->setRememberColumnSelectionEnabled();
    }

    public function builder(): Builder
    {
        return $this->model::query()
            ->select('subject_type', 'subject_id', 'causer_type', 'causer_id')
            ->when($this->columnSearch['id'] ?? null, fn ($query, $id) => $query->where('id', $id))
            ->when($this->columnSearch['description'] ?? null, fn ($query, $description) => $query->where('description', 'like', '%' . $description . '%'))
            ->when($this->columnSearch['causer'] ?? null, fn ($query, $causer) => $query->whereHas(
                'causer',
                function ($subQuery) use ($causer) {
                    $subQuery->where('name', 'like', '%'.$causer.'%');
                }
            ))
            ->when($this->columnSearch['subject'] ?? null, fn ($query, $subject) => $query->whereHas(
                'subject',
                function ($subQuery) use ($subject) {
                    $subQuery->where('name', 'like', '%'.$subject.'%');
                }
            ));
    }
}
