<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ProfileChangeRequest;
use App\User;

class ProfileChangeController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user_profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user_profile)
    {
        // 認可機能 (認証ユーザーとルートパラメータで取得したユーザーが一致するかを判定)
        $this->authorize('update', $user_profile);
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
        // 認可機能 (認証ユーザーとルートパラメータで取得したユーザーが一致するかを判定)
        $this->authorize('update', $user_profile);
        $user_profile->fill($request->all())->save();
        return redirect()->route('user-profile.edit', [$user_profile])
            ->with('status', 'プロフィールを変更しました。');
    }
}
