<?php

namespace App\Http\Requests\Graph;

use Illuminate\Foundation\Http\FormRequest;

class GraphImageSaveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'graph_image' => ['required', 'file', 'image', 'mimes: jpeg,png,jpg,gif', 'max: 1024'],
        ];
    }
    public function attributes()
    {
        return [
            'graph_image' => '画像',
        ];
    }

    public function messages()
    {
        return [
            "image" => "指定されたファイルが画像ではありません。",
            "mines" => "拡張子が PNG/JPG/GIF のファイルを指定してください",
            "max" => "ファイルサイズは１Ｍ以下としてください。",
        ];
    }
}
