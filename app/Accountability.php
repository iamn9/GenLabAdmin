<?php

namespace App;

use App\Cart;
use App\Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Accountability extends Model
{
    public $timestamps = false;  
    protected $table = 'accountabilities';

	public function getID(){
        return $this->id;
    }

    public function getOwner(){
        return Cart::findOrFail($this->cart_id)->getOwner();
    }

    public function getOwnerID(){
        return DB::table('carts')->where('id',$this->cart_id)->value('borrower_id');
    }

    public function getItemName(){
        return DB::table('items')->where('id',$this->item_id)->value('name');
    }
}