<?php

namespace App\Http\Controllers\Top;

use App\Http\Controllers\Controller;

class TopPageController extends Controller
{
    public function showTop()
    {
        return view('top.top');
    }

    public function showUserPolicy()
    {
        return view('top.user_policy');
    }

    public function showPrivacyPolicy()
    {
        return view('top.privacy_policy');
    }
}
