<?php

namespace App\Http\Controllers\Traits;

trait Serialization
{
    public function encode(array $value) : string
    {
        return trim(json_encode($value), '{}');
    }

    public function decode(string $value) : array
    {
        return json_decode('{' . $value . '}', true);
    }
}