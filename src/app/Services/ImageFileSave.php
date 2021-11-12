<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileSave
{
    /**
     * アバター画像をリサイズして保存
     *
     * @param UploadedFile $file アップロードされたアバター画像
     * @return string ファイル名
     */
    public function saveAvatarImage(UploadedFile $upload_file): string
    {
        $temp_path = $this->makeTempPath();

        // 一時ファイルにリサイズ画像を格納
        Image::make($upload_file)->fit(200, 200)->save($temp_path);

        // リサイズ画像をstorageの指定フォルダに格納
        $file_path = Storage::disk('public')
        ->putFile('avatar_images', new File($temp_path));

        return basename($file_path);
    }

    /**
     * 一時的なファイルを生成してパスを返す。
     *
     * @return string ファイルパス
     */
    private function makeTempPath(): string
    {
        // テンポラリファイルを作成 (返り値：ファイルポインタ)
        $tmp_fp = tmpfile();
        // ファイルポインタからメタデータを取得
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
