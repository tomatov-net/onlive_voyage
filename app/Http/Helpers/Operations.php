<?php

namespace App\Http\Helpers;


trait Operations
{
    public function calculate($number1, $number2, $operation)
    {
        $result = '';
        $message = '';
        $number1 = intval($number1);
        $number2 = intval($number2);

        if(!is_int($number1)){
            return [ 'result' => '',
                'message' => 'Число1 должно быть целым'
            ];
        }
        if(!is_int($number2)){
            return [ 'result' => '',
                'message' => 'Число2 должно быть целым'
            ];
        }
        if($operation == '*'){
            $result = $number1 * $number2;
        }
        elseif($operation == '-'){
            $result = $number1 - $number2;

        }
        elseif($operation == '+'){
            $result = $number1 * $number2;

        }
        elseif($operation == '/'){
            try{
                $result = $number1 / $number2;
            }
            catch (\Exception $e){
                $result = '';
                $message = 'Деление на ноль';
            }
        }

        return [ 'result' => $result,
            'message' => $message
        ];

    }
}
