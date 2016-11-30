<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Item.
 *
 * @author  The scaffold-interface created at 2016-11-30 06:49:55am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Item extends Model
{
	
	use SoftDeletes;

	protected $dates = ['deleted_at'];
    
	
    public $timestamps = false;
    
    protected $table = 'items';

	
}
