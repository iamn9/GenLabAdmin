<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Cart;
use App\Cart_item;
use App\Transaction;
use App\User;

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

    public static function format_date($date){
        $date_created = date_create($date);
        return date_format($date_created, 'F j\, Y g:ia');
    }

    public static function student_name($student_no){
    	$student = \App\User::where('id_no', '=', $student_no)->first();
    	return $student->name;
    }
}