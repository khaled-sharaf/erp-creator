<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @apiSuccess void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @apiParam  string  $attribute
     * @apiParam  mixed  $value
     * @apiSuccess bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @apiSuccess string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
