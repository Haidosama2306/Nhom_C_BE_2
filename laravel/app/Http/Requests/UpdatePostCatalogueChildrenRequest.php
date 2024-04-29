<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostCatalogueChildrenRequest extends FormRequest
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
            'name'=>'required|string|unique:post_catalogues_children,name, '.$this->id.'|regex:/^[^\d]+$/',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập tên nhóm bài viết cha',
            'name.string'=>'Tên nhóm bài viết cha phải là dạng ký tự',
            'name.regex'=>'Tên nhóm bài viết cha không được chưa ký tự số',
            'name.unique'=>'Tên nhóm bài viết con này đã tồn tại. Hãy nhập tên khác',
        ];
    }
}
