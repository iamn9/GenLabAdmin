<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    public $timestamps = false;   
    protected $table = 'transactions';

    public function getOwner(){
        $borrower = DB::table('carts')->where('id',$this->cart_id)->value('borrower_id');
        $borrowerName = DB::table('users')->where('id_no',$borrower)->value('name');
        return $borrowerName;
    }
}
