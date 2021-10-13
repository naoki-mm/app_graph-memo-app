<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserBasicController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user_basic
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_basic)
    {
        $this->authorize('update', $user_basic);
        return view('users.basic_edit', compact('user_basic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}
