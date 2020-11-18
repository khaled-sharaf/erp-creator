<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    

    private $min = 8;
    private $max = 14;

    public function __construct($min = null, $max = null)
    {
        $this->min = $min != null ? $min : $this->min;
        $this->max = $max != null ? $max : $this->max;
    }

    

    public function passes($attribute, $value)
    {
        $pattern = "/^\+?\d{" . $this->min . "," . $this->max . "}$/";

        return preg_match($pattern, $value);
    }


    public function message()
    {
        return trans('validation.phone_number');
    }
    
}
