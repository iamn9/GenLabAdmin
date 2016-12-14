<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cart_item.
 *
 * @author  The scaffold-interface created at 2016-12-13 02:19:43am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Cart_item extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'cart_items';

	
}
