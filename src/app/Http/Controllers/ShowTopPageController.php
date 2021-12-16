<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowTopPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('top');
    }
}
