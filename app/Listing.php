<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listing.
 *
 * @author  The scaffold-interface created at 2016-12-12 06:48:47am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Listing extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'listings';

	
}
