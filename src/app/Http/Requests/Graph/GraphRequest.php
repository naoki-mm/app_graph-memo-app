<?php

namespace App\Http\Requests\Graph;

use Illuminate\Foundation\Http\FormRequest;

class GraphRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:50'],
            'memo' => ['nullable', 'string', 'max:300'],
            // 'graph_image' => ['required', 'file', 'image'],

            'graph_image_text' => ['required'],

            'data' => ['required', 'string', 'max:1000'],

            // 桁数14桁以内(整数、小数部は7桁以内)。負数・小数点はtrue。ドットで始まる小数・指数表記・0で始まり続く数はfalse。
            'x_min_value' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'x_max_value' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_min_value' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_max_value' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],

            'x_min_plot_x' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'x_min_plot_y' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'x_max_plot_x' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'x_max_plot_y' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_min_plot_x' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_min_plot_y' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_max_plot_x' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],
            'y_max_plot_y' => ['required', 'numeric', 'regex:/^-?([1-9]\d{0,6}|0)(\.\d{1,7})?$/u'],

            'width' => ['required', 'integer'],
            'height' => ['required', 'integer'],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'グラフタイトル',
            'memo' => 'メモ',
            'graph_image' => 'グラフ画像',
            'data' => 'プロットデータ',
            'x_min_value' => 'x軸(min)の設定値',
            'x_max_value' => 'x軸(max)の設定値',
            'y_min_value' => 'y軸(min)の設定値',
            'y_max_value' => 'y軸(max)の設定値',
        ];
    }

    public function messages()
    {
        return [
            'regex' => '整数・小数部はそれぞれ7桁以下(指数表記はNG)で入力してください。',
        ];
    }
}
