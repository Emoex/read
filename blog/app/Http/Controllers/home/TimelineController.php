<?php

namespace App\Http\Controllers\home;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\home\timelineStore;
use App\Models\Timeline;
use DB;
use App\models\TimelineCate;
use App\Models\TimelineLike; 
use App\Models\User;
use App\Models\TimeLineComment;

class TimelineController extends Controller
{   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        //判断是否有session 并获取用户的id 往后来查是否有喜欢的碎片
        if( session('user') ){
            $uid = session('user')['id'];
        }
        if( $p=$request->input('p') && $num=$request->input('num') && $id=$request->input('cid') ){
            $p = $request->input('p');
            $num = $request->input('num');
            $cate = TimelineCate::find($id);
            $data = $cate->timeline()->skip(($p-1)*$num)->take($num)->orderBy('time','desc')->get();
            if(!$data->isEmpty()){
                foreach ($data as $k => $v) {
                   $v['uid'] = $v->User->id;
                   $v['nickname'] = $v->User->nickname;
                   $v['face'] = $v->User->face;
                   if( isset($uid) ){
                        $v['like'] = Timelinelike::where('tid',$v['id'])->where('uid',$uid)->first();
                   }
                }
                echo json_encode($data);
            }else{
                echo json_encode(['msg'=>'error']);
            }
        }else if( $p = $request->input('p') && $num=$request->input('num') ){
            $p = $request->input('p');
            $data = Timeline::offset(($p-1)*$num)->limit($num)->orderBy('time','desc')->get();
            if(!$data->isEmpty()){
                foreach ($data as $k => $v) {
                   $v['uid'] = $v->User->id;
                   $v['nickname'] = $v->User->nickname;
                   $v['face'] = $v->User->face;
                   if( isset($uid) ){
                        $v['like'] = Timelinelike::where('tid',$v['id'])->where('uid',$uid)->first();
                    }
                }
                echo json_encode($data);
            }else{
                echo json_encode(['msg'=>'error']);
            }
        }else if( $request->input('cid') ){
            $cid = $request->input('cid');
            $name = TimelineCate::find($cid)['name'];
            $cate = TimelineCate::get();
            return view('home/Timeline/index',['cate'=>$cate,'cid'=>$cid,'name'=>$name]);
        }
        else{
            $cate = TimelineCate::get();
            return view('home/Timeline/index',['cate'=>$cate]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // dump($request->all());
        if(!$request->filled('content')){
            echo 'empty';
        }else{
            //开启事务
            DB::beginTransaction();
            //接收除了图片的其他东西
            $data = $request->except('profile');
            //添加时间字段
            $data['time'] = date('Y-m-d H:i:s',time());
            //uid为session的id
            $data['uid'] = session('user')['id'];
            //判断是否为秘密
            if($data['cid'] == '秘密'){
                $data['public'] = 2;
            }else{
                $data['public'] = 1;
            }
            $cate = TimelineCate::where('name',$data['cid'])->first();
            //判断属于哪个标签
            if($data['cid'] != '添加标签'){ 
                //这条数据的cid
                $data['cid'] = $cate['id'];
                //自增
                $res1 = TimelineCate::where( 'id',$data['cid'] )->increment('num');
                if($request->hasfile('profile')){
                    $image = $request->file('profile')->store('images');
                    $data['image'] = '/uploads/'.$image;
                    $res2 = Timeline::insert($data);
                    if($res1 && $res2){
                        DB::commit();
                        echo 'success';
                    }else{
                        DB::rollBack();
                        echo 'Serror';
                    }     
                }else{
                    $res2 = Timeline::insert($data);
                    if($res1 && $res2){
                        DB::commit();
                        echo 'success';
                    }else{
                        DB::rollBack();
                        echo 'Serror';
                    }
                }
            }else{
                $data['cid'] = null;
                if($request->hasfile('profile')){
                    $image = $request->file('profile')->store('images');
                    $data['image'] = '/uploads/'.$image;
                    $res = Timeline::insert($data);
                    if($res){
                        DB::commit();
                        echo 'success';
                    }else{
                        DB::rollBack();
                        echo 'Serror';
                    }     
                }else{
                    $res = Timeline::insert($data);
                    if($res){
                        DB::commit();
                        echo 'success';
                    }else{
                        DB::rollBack();
                        echo 'Serror';
                    }
                }
            }   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {   
        //根据show方法传过来的id去找相对应的碎片
        $data = Timeline::find($id);
        //喜欢的个数( 调用love()多对多方法 )
        $likes = $data->love()->count();
        //判断是否有session 并获取用户的id 往后来查是否有喜欢的碎片
        if( session('user') ){
            $uid = session('user')['id'];
        }
        if( isset($uid) ){
            $data['like'] = Timelinelike::where('tid',$id)->where('uid',$uid)->first();
        }
        //查看用户评论的内容
        $comment = $data->Comment()->where('parent_id',0)->orderBy('time','desc')->get();
        if( !$comment->isEmpty()){
            foreach ($comment as $k => $v) {
                $v['children'] = TimeLineComment::where('parent_id',$v['id'])->orderBy('time','desc')->get();
            }
        }
        $cid = $data['cid'];
        //相关数据 inRandomOrder() 随机四条数据
        $likeness = timeline::where('id','!=',$id)->where('cid',$cid)->inRandomOrder()->take(4)->get();
        foreach ($likeness as $k => $v) {
           $v['uid'] = $v->User->id;
           $v['nickname'] = $v->User->nickname;
           $v['face'] = $v->User->face;
           if( isset($uid) ){
                $v['like'] = Timelinelike::where('tid',$v['id'])->where('uid',$uid)->first();
           }
        }
        $cate = TimelineCate::get();
        return view('home/Timeline/show',['data'=>$data,'comment'=>$comment,'cate'=>$cate,'likeness'=>$likeness,'likes'=>$likes]);
    }

    public function like(Request $request)
    {
        $tid = $request->input('id');
        $uid = session('user')['id'];
        $res = TimelineLike::where('tid',$tid)->where('uid',$uid)->first();
        if(!$res){
            $timelineLike = new TimelineLike;
            $timelineLike->tid = $tid;
            $timelineLike->uid = $uid;
            $res = $timelineLike->save();
            echo 'success';
        }else{
            $id = $res['id'];
            Timelinelike::where('id',$id)->delete();
            echo 'error';
        }

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        //开启事务
        DB::beginTransaction();
        $data = Timeline::find($id);
        //判断是否有喜欢的记录
        $jilu = TimelineLike::where('tid',$data['id'])->first();
        if( $jilu ){
            //删除这个碎片
            $res1 = Timeline::where('id',$id)->delete();
            //查找对应的分类下的num -- 
            $res2 = TimelineCate::where('id',$data['cid'])->decrement('num');
            //删除喜欢表中所有的数据
            $res3 = TimelineLike::where('tid',$data['id'])->delete();
            if( $res1 && $res2 && $res3){
                DB::commit();
                echo 'success';
            }else{
                DB::rollBack();
                echo 'error';
            }
        }else{
            //删除这个碎片
            $res1 = Timeline::where('id',$id)->delete();
            //查找对应的分类下的num -- 
            $res2 = TimelineCate::where('id',$data['cid'])->decrement('num');
            if( $res1 && $res2 ){
                DB::commit();
                echo 'success';
            }else{
                DB::rollBack();
                echo 'error';
            }
        }
        
    }
}
