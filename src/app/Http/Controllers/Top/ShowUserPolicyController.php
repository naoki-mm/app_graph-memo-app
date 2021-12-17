<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowUserPolicyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('top.user_policy');
    }
}
