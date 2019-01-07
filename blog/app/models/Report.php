<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';

    public function User()
    {
    	return $this->belongsTo('App\models\User','uid');
    }
}
