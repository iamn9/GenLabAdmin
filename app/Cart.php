<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    public $timestamps = false;  
    protected $table = 'carts';

	public function getID(){
        return $this->id;
    }

    public function getOwner(){
        return DB::table('users')
        ->where('users.id_no',$this->borrower_id)
        ->value('name');
    }

    public function getSize(){
        return DB::table('cart_items')
        ->where('cart_id', $this->id)
        ->count();
    }
}
