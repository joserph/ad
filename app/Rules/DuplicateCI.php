<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class DuplicateCI implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        // dd($value);
        if(count($value) > count(array_unique($value))){
            $fail("Se encontraron miembros duplicados en la lista.");
        }
    }
}
