<?php

namespace Joselfonseca\LAravelAdminBlog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as Request;

class CreateBlogRequest extends Request
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
            'title' => 'required',
            'categories' => 'required',
            'tags' => 'required',
            'intro' => 'required',
            'body' => 'required'
        ];
    }
}
