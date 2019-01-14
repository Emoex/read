<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    protected $table = 'follow';

    public function User()
    {
    	return $this->belongsTo('App\models\User','uid');
    }

    public function Follow_user()
    {
    	return $this->belongsTo('App\models\User','follow_user');
    }
}
