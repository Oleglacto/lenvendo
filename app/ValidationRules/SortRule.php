<?php declare(strict_types=1);

namespace App\ValidationRules;

use Illuminate\Contracts\Validation\Rule;

class SortRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$value) {
            return true;
        }

        return $value === 'asc' || $value === 'desc';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be desc or asc.';
    }
}
