<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => 'required',
            'password_new' => 'required|min:8|different:password',
            'password_new_confirm' => 'required|min:8|different:password'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Vui lòng nhập mật khẩu cũ',
            'password_new.required' => 'Vui lòng nhập mật khẩu mới',
            'password_new.min' => 'Mật khẩu tối thiểu phải 8 ký tự',
            'password_new.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ',
            'password_new_confirm.required' => 'Vui lòng xác nhận lại mật khẩu mới',
            'password_new_confirm.min' => 'Mật khẩu tối thiểu phải 8 ký tự',
            'password_new_confirm.different' => 'Mật khẩu mới không được trùng với mật khẩu cũ'
        ];
    }
}
