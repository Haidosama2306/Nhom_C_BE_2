<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostCatalogueChildrenRequest extends FormRequest
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
            'name'=>'required|string|unique:post_catalogues_children|regex:/^[^\d]+$/',
            'post_catalogue_parent_id'=>'required|integer|gt:0',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập tên nhóm bài viết con',
            'name.string'=>'Tên nhóm bài viết con phải là dạng ký tự',
            'name.unique'=>'Tên nhóm bài viết con này đã tồn tại. Hãy nhập tên khác',
            'name.regex'=>'Tên nhóm bài viết con không được chưa ký tự số',
            'post_catalogue_parent_id'=>'Bạn chưa chọn nhóm bài viết cha',

        ];
    }
}
