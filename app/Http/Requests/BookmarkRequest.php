<?php declare(strict_types=1);

namespace Gallery\Images\Http\Requests;

namespace App\Http\Requests;

use App\ValidationRules\SortRule;
use Illuminate\Validation\Rule;

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
            'sortBy' => [
                'string',
                new SortRule,
            ],
            'page' => 'string'
        ];
    }
}
