<?php

namespace App\Http\Requests\home;

use Illuminate\Foundation\Http\FormRequest;

class UserStore extends FormRequest
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
           'reuname'=>'required',
           'repwd'=>'required',
        ];
    }

    public function messages()
   {
       return [
        'reuname.required' => '用户名不能为空',
        'repwd.required'  => '密码不能为空',
    ];
   }
}
