<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TingStore extends FormRequest
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

            'img'=>'required',
            'title'=>'required',
            'music'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required'=>'标题不能为空',
            'img.required'=>'请选择封面',
            'music.required'=>'请添加电台音乐',
        ];
    }

}
