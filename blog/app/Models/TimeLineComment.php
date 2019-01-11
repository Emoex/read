<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLineComment extends Model
{
    public $table = 'timeline_comment';

    public $primaryKey = 'id';

    //评论与用户是 属于关系
    public function User()
    {
    	return $this->belongsTo('App\models\User','uid');
    }
}
