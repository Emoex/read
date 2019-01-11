<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    public $table = 'timeline';

    public function User()
    {
    	return $this->belongsTo('App\models\User','uid');
    }
}
