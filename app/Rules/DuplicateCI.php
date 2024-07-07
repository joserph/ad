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
        
        for($i = 9; $i >= 0; $i--){
            // dd($value[$i]);
            if(empty($value[$i])){
                unset($value[$i]);
            }
        }
        if(count($value) > count(array_unique($value))){
            $fail("Se encontraron miembros duplicados en la lista.");
        }
        // if(array_values(array_diff_assoc($value, array_unique($value)))){
        //     $fail("Se encontraron miembros duplicados en la lista.");
        // }

        // $arrFinal = array_filter($value, function($item){
        //     $notEmpty=count($item) == count(array_filter(array_map('trim', $item)));
        //     return $notEmpty;
        // });
        // dd(count($value));
       
    }
}
