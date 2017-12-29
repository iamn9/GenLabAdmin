<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Listing extends Model
{
    public $timestamps = false;  
    protected $table = 'listing';

	public function getID(){
        return $this->id;
    }

    public function getOwner(){
        return DB::table('users')
        ->where('users.id_no',$this->owner_id)
        ->value('name');
    }

    public function getSize(){
        return DB::table('listing_items')
        ->where('listing_id', $this->id)
        ->count();
    }
}
