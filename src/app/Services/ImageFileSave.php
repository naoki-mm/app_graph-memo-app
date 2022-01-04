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
     * @param bool $is_fit リサイズ有無
     * @return string ファイル名
     */
    public function saveImage(UploadedFile $upload_file, bool $is_fit, string $directory_name): string
    {
        $temp_path = $this->makeTempPath();

        if ($is_fit) {
            // 一時ファイルにリサイズ画像を格納
            Image::make($upload_file)->fit(200, 200)->save($temp_path);
        } else {
            Image::make($upload_file)->save($temp_path);
        }

        $file_path = Storage::disk('s3')
        ->putFile($directory_name, new File($temp_path));

        return basename($file_path);
    }

    /**
     * 一時的なファイルを生成してパスを返す。
     *
     * @return string ファイルパス
     */
    private function makeTempPath(): string
    {
        // テンポラリファイルを作成
        $tmp_fp = tmpfile();
        // ファイルポインタからメタデータを取得
        $meta = stream_get_meta_data($tmp_fp);
        return $meta["uri"];
    }
}
