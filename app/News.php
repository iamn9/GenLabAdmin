<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class News extends Model
{
    public $timestamps = false;  
    protected $table = 'news';

	public function getID(){
        return $this->id;
    }
    public function getreporter_id(){
        return $this->reporter_id;
    }

   
}
