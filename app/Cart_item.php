<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart_item extends Model
{
    public $timestamps = false;   
    protected $table = 'cart_items';
}
