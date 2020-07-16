<?php declare(strict_types=1);

namespace Gallery\Images\Http\Requests;

namespace App\Http\Requests;

use App\ValidationRules\SortRule;
use Illuminate\Validation\Rule;

class SearchBookmarkRequest extends ApiStrictFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'query' => 'required|string',
            'sortBy' => [
                'string',
                new SortRule,
            ],
            'page' => 'string'
        ];
    }
}
