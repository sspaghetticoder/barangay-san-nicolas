<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\Serialization;
use Illuminate\Support\Facades\Route;

class DocumentController extends Controller
{
    use Serialization;

    public array $params = [];

    public function __construct()
    {
        $this->params = $this->decode(Route::current()->parameter('params'));
    }

    public function indigency()
    {
        return view('documents.indigency', $this->params);
    }

    public function residency()
    {
        return view('documents.residency', $this->params);
    }

    public function clearance()
    {
        return view('documents.clearance', $this->params);
    }
}
