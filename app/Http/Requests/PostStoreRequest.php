<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'post_title'       => 'required',
            'post_slug'        => 'required|unique:posts,slug',
            'post_content'     => 'required',
            'post_description' => 'nullable',
            'post_category_id' => 'required|numeric',
            'post_tags'        => 'nullable',
            'post_thumbnail'   => 'nullable|file',
        ];
    }
}
