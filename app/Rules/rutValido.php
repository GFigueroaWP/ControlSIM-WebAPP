<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\InvokableRule;

class rutValido implements InvokableRule
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
        $dv = substr($value, -1);
        $rut = substr($value, 0, -1);
        $rut = preg_replace('/[^0-9]+/', '', $rut);
        $rut = strrev($rut);
        $length = strlen($rut);
        $rut = str_split($rut);
        $rut = array_map('intval', $rut);

        $suma = 0;
        $multiplo = 2;

        for($i=0; $i < $length;$i++){
            $suma = $suma + ($rut[$i]*$multiplo);
            if($multiplo < 7){
                $multiplo++;
            }else{
                $multiplo = 2;
            }
        }

        $resto = $suma%11;

        $digito = 11 - $resto;

        if($digito == 10){
            $digito = 'K';
        }else if($digito == 11){
            $digito = 0;
        }
        if($dv != $digito){
            $fail('El rut no es valido');
        }
    }
}
