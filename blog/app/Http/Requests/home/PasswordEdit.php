<?php

namespace App\Http\Requests\home;

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
           'oldPwd_edit'=>'required',
           'newPwd_edit'=>'required',
           'renewPwd_edit'=>'required|same:newPwd_edit',
        ];
    }

   public function messages()
   {
       return [
        'oldPwd_edit.required' => '旧密码不能为空',
        'newPwd_edit.required' => '请输入新密码',
        'renewPwd_edit.required' => '请再次输入密码',
        'renewPwd_edit.same' => '两次密码不一致',
    ];
   }
}
