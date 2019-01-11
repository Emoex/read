<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PasswordEdit extends FormRequest
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
            'oldPwd'=>'required',
           'newPwd'=>'required',
           'reNewPwd'=>'required|same:newPwd',
        ];
    }

    public function messages()
   {
       return [
        'oldPwd.required' => '旧密码不能为空',
        'newPwd.required' => '请输入新密码',
        'reNewPwd.required' => '请再次输入密码',
        'reNewPwd.same' => '两次密码不一致',
    ];
   }
}
