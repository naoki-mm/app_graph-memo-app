<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class DeleteAccountController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $delete_account
     * @return \Illuminate\Http\Response
     */
    public function edit(User $delete_account)
    {
        $delete_active_flag = true;

        return view('users.account_delete', compact('delete_account', 'delete_active_flag'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $delete_account
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $delete_account)
    {
        $delete_account->delete();
        Auth::logout();
        return redirect('/');
    }
}
