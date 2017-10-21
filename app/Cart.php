<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    public $timestamps = false;  
    protected $table = 'carts';

	public function getID(){
        return $this->id;
    }
}
