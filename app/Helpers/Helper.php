<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function shout(string $string)
    {
        return strtoupper($string);
    }
    
    public static function cartItemStatus($key){
    
        if($key=='0'){
            return 'Not Available';
        }
        elseif($key=='1'){
            return 'Released';
        }
        elseif ($key=='2') {
            return 'Damaged';
        }
        elseif ($key=='3') {
            return 'Returned';
        }
    }
}