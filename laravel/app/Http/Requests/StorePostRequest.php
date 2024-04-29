<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'name'=>'required|string',
            'post_catalogue_parent_id'=>'required|integer|gt:0',
            'post_catalogue_children_id'=>'required|integer|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập tiêu đề bài viết',
            'name.string'=>'Tiêu đề bài viết phải là dạng ký tự',
            'post_catalogue_parent_id'=>'Bạn chưa chọn nhóm bài viết cha',
            'post_catalogue_children_id'=>'Bạn chưa chọn nhóm bài viết con',
        ];
    }
}
