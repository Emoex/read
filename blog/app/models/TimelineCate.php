<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TimelineCate extends Model
{
   	public $table = 'timeline_cate';

   	public $primaryKey = 'id';

   	public function timeline()
   	{
   		return $this->hasMany('App\Models\Timeline','cid');
   	}
}
