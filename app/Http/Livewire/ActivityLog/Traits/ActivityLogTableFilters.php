<?php

namespace App\Http\Livewire\ActivityLog\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;

trait ActivityLogTableFilters
{
    public function filters(): array
    {
        return [
            DateFilter::make('Created From', 'created_from')
                ->filter(fn(Builder $builder, string $value) => $builder->whereDate('created_at', '>=', Carbon::parse($value)->format('Y-m-d'))),
            DateFilter::make('Created Until', 'created_until')
                ->filter(fn(Builder $builder, string $value) => $builder->whereDate('created_at', '<=', Carbon::parse($value)->format('Y-m-d'))),
        ];
    }
}