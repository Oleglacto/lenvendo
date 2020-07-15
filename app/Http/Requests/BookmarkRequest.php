<?php

namespace Gallery\Images\Http\Requests;

namespace App\Http\Requests;

class BookmarkRequest extends ApiStrictFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|url'
        ];
    }
}
