<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;


class UpdateUserRequest extends FormRequest
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
        return [
            'email' => 'required|string|email|unique:users,email, '.$this->id.'|max:255',
            'name'=>'required|string|regex:/^[^\d]+$/',
            'user_catalogue_id'=> [
                'required',
                'integer',
                'gt:0',
    
                function ($attribute, $value, $fail) {
                    if (auth()->user()->user_catalogue_id == 1 && $value != 1) {
                        $fail('Bạn đang là Quản Trị Viên, nếu bạn muốn chuyển đổi chức vụ vui lòng liên hệ admin sđt: 0333444555.');
                    }
                },
                function ($attribute, $value, $fail) {
                    if (auth()->user()->user_catalogue_id != 1) {
                        $exists = User::where('user_catalogue_id', 1);
                        if ($exists) {
                            $fail('Nhóm quản trị viên này đã có người đảm nhận.');
                        }
                    }else{
                        $user_id = $this->route('id');
                        if ($user_id != auth()->user()->id && $value == 1) {
                            $exists = User::where('user_catalogue_id', 1);
                            if ($exists) {
                                $fail('Nhóm quản trị viên này đã có người đảm nhận.');
                            }
                        }
                    }
                },
            ],
            'phone'=>'required|string|regex:/^0[0-9]{9}$/'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'=>'Bạn chưa nhập email.',
            'email.email'=>'Email chưa đúng định dạng. VD: abc@gmail.com',
            'email.string'=>'Email phải là dạng ký tự',
            'email.unique'=>'Email đã tồn tại. Hãy chọn email khác',
            'email.max'=>'Độ dài email tối đa 255 ký tự',
            'name.required'=>'Bạn chưa nhập họ tên',
            'name.string'=>'Tên phải là dạng ký tự',
            'name.regex'=>'Tên không được chứa ký tự số',
            'user_catalogue_id.required'=>'Bạn chưa chọn nhóm thành viên',
            'user_catalogue_id.unique'=>'Nhóm quản trị viên này đã có người đãm nhận',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'phone.regex'=>'Số điện không hợp lệ vui lòng nhập theo định dạng: 0xxxxxxxxx'
        ];
    }
}
