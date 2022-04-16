<?php

namespace App\Http\Livewire\Resident\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

trait ResidentTableFilters
{
    public function filters(): array
    {
        return [
            SelectFilter::make('Show')
            ->options([
                '' => 'All',
                'deleted' => 'Deleted only',
            ])
            ->filter(function (Builder $builder, string $value) {
                if ($value === 'deleted') $builder->whereNotNull('deleted_at');
            }),
            DateFilter::make('Created From', 'created_from')
                ->filter(fn(Builder $builder, string $value) => $builder->whereDate('created_at', '>=', Carbon::parse($value)->format('Y-m-d'))),
            DateFilter::make('Created Until', 'created_until')
                ->filter(fn(Builder $builder, string $value) => $builder->whereDate('created_at', '<=', Carbon::parse($value)->format('Y-m-d'))),
        ];
    }
}