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
        ->join('carts', function($join){
            $join->on('carts.borrower_id', '=', 'users.id_no');
        })->value('name');
    }
}
