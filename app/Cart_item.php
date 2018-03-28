<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cart_item extends Model
{
    public $timestamps = false;   
    protected $table = 'cart_items';

    public function getFee(){
        $item_id = $this->item_id;
		$firsthour = Item::where('id', '=', $item_id)->value('firsthour');		
		if($firsthour == 0){
			return $firsthour;
		}		
        $released_at = Transaction::where('cart_id','=',$this->cart_id)->value('released_at');
        if($released_at == NULL)
            return 0.00;

        $completed_at = Transaction::where('cart_id','=',$this->cart_id)->value('completed_at');
        if($completed_at == NULL)
            $completed_at = date("Y-m-d H:i:s"); 

        $diff = date_diff( date_create($released_at), date_create($completed_at), true);
        $elapsed_hours = $diff->h + $diff->d*24 + $diff->m*24*30 + $diff->y*24*30*12;
		
		$succeeding_hours = Item::where('id', '=', $item_id)->value('succeeding');
		$total_fee = $succeeding_hours*$elapsed_hours + $firsthour;
		return number_format($total_fee, 2);
    }

    public function getTotalFee(){
        return number_format($this->getFee()*$this->qty);
    }

    public function getItemName(){
        $itemName = DB::table('items')->where('id',$this->item_id)->value('name');
        return $itemName;
    }

    public function getItemBrand(){
        $itemBrand = DB::table('items')->where('id',$this->item_id)->value('brand');
        return $itemBrand;
    }

    public function getItemDescription(){
        $itemDescription = DB::table('items')->where('id',$this->item_id)->value('description');
        return $itemDescription;
    }
}
