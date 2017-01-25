<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction.
 *
 * @author  The scaffold-interface created at 2016-12-19 04:15:39am
 * @link  https://github.com/amranidev/scaffold-interface
 */
class Transaction extends Model
{
	
	
    public $timestamps = false;
    
    protected $table = 'transactions';

	
}
