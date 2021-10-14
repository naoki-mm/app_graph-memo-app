<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\BasicRequest;
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
        // 認可機能 (認証ユーザーとルートパラメータで取得したユーザーが一致するかを判定)
        $this->authorize('update', $user_basic);
        return view('users.basic_edit', compact('user_basic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  \App\User $user_basic
     * @return \Illuminate\Http\Response
     */
    public function update(BasicRequest $request, User $user_basic)
    {
        // 認可機能 (認証ユーザーとルートパラメータで取得したユーザーが一致するかを判定)
        $this->authorize('update', $user_basic);
        $user_basic->fill($request->all())->save();
        return redirect()->route('user-basic.edit', [$user_basic])
            ->with('status', 'プロフィールを変更しました。');
    }
}
