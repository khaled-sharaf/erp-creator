<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Amount implements Rule
{
    
    private $min = 0;
    private $max = 10;
    private $minF = 1;
    private $maxF = 2;

    public function __construct($min = null, $max = null, $minF = null, $maxF = null)
    {
        $this->min = $min != null ? $min : $this->min;
        $this->max = $max != null ? $max : $this->max;
        $this->minF = $minF != null ? $minF : $this->minF;
        $this->maxF = $maxF != null ? $maxF : $this->maxF;
    }


    public function passes($attribute, $value)
    {
        $pattern = "/^\d{" . $this->min . "," . $this->max . "}(\.\d{" . $this->minF . "," . $this->maxF . "})?$/";
        
        return preg_match($pattern, $value);
    }

    

    public function message()
    {
        return trans('validation.amount');
    }
}
