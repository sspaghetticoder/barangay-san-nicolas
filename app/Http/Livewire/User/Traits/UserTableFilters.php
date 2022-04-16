<?php

namespace App\Http\Livewire\User\Traits;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

trait UserTableFilters
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
            SelectFilter::make('Active')
                ->options([
                    '' => 'All',
                    '1' => 'Yes',
                    '0' => 'No',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                }),
            DateFilter::make('Created From', 'created_from')
                ->filter(fn (Builder $builder, string $value) => $builder->whereDate('created_at', '>=', Carbon::parse($value)->format('Y-m-d'))),
            DateFilter::make('Created Until', 'created_until')
                ->filter(fn (Builder $builder, string $value) => $builder->whereDate('created_at', '<=', Carbon::parse($value)->format('Y-m-d'))),
        ];
    }
}
