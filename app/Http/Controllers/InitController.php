<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InitController extends Controller
{
    public $appUrl;

    public function _construct()
    {
        $this->appUrl = \Request::root();
    }
}
