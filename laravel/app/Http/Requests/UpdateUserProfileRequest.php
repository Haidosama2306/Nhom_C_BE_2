<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name'=>'required|string|regex:/^[^\d]+$/',
            'phone'=>'required|string|regex:/^0[0-9]{9}$/',
            'oldpassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, auth()->user()->password)) {
                        $fail('Mật khẩu cũ không đúng.');
                    }
                },
            ],
        ];
        if (request()->filled('password')) {
            $rules['password'] = 'required|string|min:6';
            $rules['repassword'] = 'required|string|min:6|same:password';

        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập họ tên',
            'name.string'=>'Tên phải là dạng ký tự',
            'name.regex'=>'Tên không được chứa ký tự số',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.regex'=>'Số điện không hợp lệ vui lòng nhập theo định dạng: 0xxxxxxxxx',
            'oldpassword.required'=>'Vui lòng nhập lại mật khẩu cũ để cập nhật profile của bạn',
            'password.required'=>'Bạn chưa nhập vào mật khẩu',
            'password.min'=>'Độ dài mật khẩu tối thiểu 6 ký tự',
            'repassword.min'=>'Độ dài mật khẩu nhập lại tối thiểu 6 ký tự',
            'password.string'=>'Mật khẩu phải là dạng ký tự',
            'repassword.same'=>'Mật khẩu nhập lại không khớp',
            'repassword.required'=>'Bạn chưa nhập nhập lại mật khẩu',
        ];
    }
}
