<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostReactionRequest extends FormRequest
{
    public function rules()
    {
        return [
            "post_id"   => "required",
            "up_vote"   => "required",
            "down_vote" => "required",
            "agree"     => "required",
            "skeptic"   => "required"
        ];
    }
}
