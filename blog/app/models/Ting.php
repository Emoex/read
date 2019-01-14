<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Ting extends Model
{
    public $table='ting';
   
    public function User()
    {
    	return $this->belongsTo('App\models\User','uid');
    }

    public function Article()
    {
    	return $this->belongsTo('App\models\Article','aid');
    }
}
