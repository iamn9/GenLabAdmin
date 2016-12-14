<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Cart.
 *
 * @author  The scaffold-interface created at 2016-12-13 01:15:11am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Cart extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'carts';

	public function getID(){
        return $this->id;
    }
}
