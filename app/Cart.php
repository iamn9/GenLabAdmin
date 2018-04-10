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

    public function getTotalFee(){
        $cart_items = Cart_item::where('cart_id','=',$this->id)->get();

        $totalPayable = 0;
        foreach($cart_items as $cart_item){
            $totalPayable += $cart_item->getFee();
        }

        return number_format($totalPayable, 2);
    }

    public function getTotalQty(){
        $cart_items = Cart_item::where('cart_id','=',$this->id)->get();
        $totalQty = 0;
        foreach($cart_items as $cart_item){
            $totalQty += $cart_item->qty;
        }

        return $totalQty;
    }
}
