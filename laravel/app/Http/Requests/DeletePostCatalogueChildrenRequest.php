<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\PostCatalogueChildren;

class DeletePostCatalogueChildrenRequest extends FormRequest
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
            'name'=>'required|string|regex:/^[^\d]+$/',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Bạn chưa nhập tên nhóm bài viết con',
            'name.string'=>'Tên nhóm bài viết con phải là dạng ký tự',
            'name.regex'=>'Tên nhóm bài viết con không được chưa ký tự số'
        ];
    }
    public function hasPosts(): bool
    {
        $postCatalogueChildren = PostCatalogueChildren::findOrFail($this->route('id'));
        return $postCatalogueChildren->posts()->exists();
    }
}
