<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\User\ProfileChangeRequest;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
        $user_profile->name = $request->input('name');

        // アバター画像がリクエストに存在した場合、画像をストレージに保存し、DBのファイル名を更新する。
        if ($request->has('avatar')) {
            $fileName = $this->saveAvatarImage($request->file('avatar'));
            $user_profile->image_name = $fileName;
        }

        $user_profile->save();

        return redirect()->route('user-profile.edit', [$user_profile])
            ->with('status', 'プロフィールを変更しました。');
    }

    /**
     * アバター画像をリサイズして保存
     *
     * @param UploadedFile $file アップロードされたアバター画像
     * @return string ファイル名
     */
    private function saveAvatarImage(UploadedFile $file): string
    {
        $tempPath = $this->makeTempPath();

        Image::make($file)->fit(200, 200)->save($tempPath);

        $filePath = Storage::disk('public')
            ->putFile('avatar_images', new File($tempPath));

        return basename($filePath);
    }

    /**
     * 一時的なファイルを生成してパスを返す。
     *
     * @return string ファイルパス
     */
    private function makeTempPath(): string
    {
        $tmp_fp = tmpfile();
        $meta   = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
