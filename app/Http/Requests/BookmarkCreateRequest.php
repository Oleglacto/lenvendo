<?php declare(strict_types=1);

namespace Gallery\Images\Http\Requests;

namespace App\Http\Requests;

class BookmarkCreateRequest extends ApiStrictFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => 'required|url|unique:bookmarks'
        ];
    }
}
