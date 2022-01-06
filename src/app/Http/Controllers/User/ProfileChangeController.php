<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\ProfileChangeRequest;
use App\User;
use App\Services\ImageFileSave;

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
        $profile_active_flag = true;

        return view('users.profile_edit', compact('user_profile', 'profile_active_flag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User $user_profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileChangeRequest $request, User $user_profile, ImageFileSave $image_file_save)
    {
        $guest_user_id = \UserIdConst::GUEST;
        // ゲストユーザーの処理防止
        if ($guest_user_id === Auth::id()) {
            return redirect()->route('user-profile.edit', [$user_profile])
                ->with('user_error_message', 'ゲストユーザーはプロフィールを変更することができません。');
        }

        $user_profile->name = $request->input('name');

        // アバター画像がリクエストに存在した場合、画像をストレージに保存し、DBのファイル名を更新する。
        if ($request->has('avatar')) {
            $fileName = $image_file_save->saveImage($request->file('avatar'), true, 'avatar_images');
            $user_profile->image_name = $fileName;
        }

        $user_profile->save();

        return redirect()->route('user-profile.edit', [$user_profile])
            ->with('status', 'プロフィールを変更しました。');
    }
}
