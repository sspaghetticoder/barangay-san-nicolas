<?php

namespace App\Models\Traits;

use App\Services\ConvertToLocalTimezoneService;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait Timestamps
{
    // private function convertToLocalTimezone($value): DateTime
    // {
    //     return (new DateTime($value, new DateTimeZone(config('app.timezone'))))
    //         ->setTimezone(new DateTimeZone(config('app.local-timezone')));
    // }

    public static function updatedAtAlias(): string
    {
        return 'Last Modified';
    }

    public static function createdAtAlias(): string
    {
        return 'Created At';
    }

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (new ConvertToLocalTimezoneService)->convert($value)->format('F d, Y'),
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (new ConvertToLocalTimezoneService)->convert($value)->format('F d, Y - h:i A'),
        );
    }
}
