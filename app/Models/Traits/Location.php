<?php

namespace App\Models\Traits;

trait Location
{
    public function getLocationAttribute()
    {
        $routeName = app(self::class)->getTable().'.show';

        return route($routeName, $this->attributes[$this->primaryKey]);
    }
}