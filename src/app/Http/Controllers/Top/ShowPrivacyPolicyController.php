<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowPrivacyPolicyController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('top.privacy_policy');
    }
}
