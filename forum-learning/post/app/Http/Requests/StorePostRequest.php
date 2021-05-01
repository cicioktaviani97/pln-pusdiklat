<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function rules()
    {
        return [
            "category_id"   => "required",
            "discussion_id"  => "required",
            "title"         => "required|min:10|max:100",
            "articles"      => "required",
            "privasi"       => "required", Rule::in(['public','participant'])
        ];
    }
}
