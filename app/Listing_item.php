<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing_item extends Model
{
    public $timestamps = false;   
    protected $table = 'listing_items';
}
