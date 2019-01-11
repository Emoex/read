<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timeline extends Model
{
    public $table = 'timeline';

    public $primaryKey = 'id';

    //与用户表 碎片的发布 属于关系 
    public function User()
    {
    	return $this->belongsTo('App\Models\User','uid');
    }
    //与碎片分类表 属于关系
    public function Cate()
    {
    	return $this->belongsTo('App\Models\TimelineCate','cid');
    }
 	//与用户表 喜欢 多对多关系
 	public function love()
 	{
 		return $this->belongsToMany('App\Models\User','timeline_like','tid','uid');
 	}
    //与评论表 一对多
    public function Comment()
    {
        return $this->hasMany('App\Models\TimeLineComment','tid');
    }
}
