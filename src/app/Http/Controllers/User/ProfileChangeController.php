<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ProfileChangeRequest;
use App\User;

class ProfileChangeController extends Controller
{
    public function __construct()
    {
        // "edit"と"update"メソッドにおいて, Policyクラスにて定義した認可機能を適用
        $this->authorizeResource(User::class, 'user_profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user_profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_profile)
    {
        return view('users.profile_edit', compact('user_profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User $user_profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileChangeRequest $request, User $user_profile)
    {
        $user_profile->fill($request->all())->save();
        return redirect()->route('user-profile.edit', [$user_profile])
            ->with('status', 'プロフィールを変更しました。');
    }
}
