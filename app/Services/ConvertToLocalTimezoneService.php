<?php

namespace App\Services;

use DateTime;
use DateTimeZone;

class ConvertToLocalTimezoneService
{
    public function convert($value)
    {
        return (new DateTime($value, new DateTimeZone(config('app.timezone'))))
        ->setTimezone(new DateTimeZone(config('app.local-timezone')));
    }
}