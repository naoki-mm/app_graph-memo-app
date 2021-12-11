<?php

namespace App\Http\Controllers\Graph;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Graph;

class TrashIndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $user_id = Auth::id();
        $graphs = Graph::onlyTrashed()->where('user_id', $user_id)->latest()->paginate(4);

        $trash_active_flag = true;

        return view('graphs.trash_index', compact('graphs', 'trash_active_flag'));
    }
}
