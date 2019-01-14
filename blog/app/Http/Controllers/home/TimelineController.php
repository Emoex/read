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
use Illuminate\Support\Facades\Storage;

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
            $data = $cate->timeline()->where('public',1)->skip(($p-1)*$num)->take($num)->orderBy('created_at','desc')->get();
            if(!$data->isEmpty()){
                foreach ($data as $k => $v) {
                   $v['uid'] = $v->User->id;
                   $v['nickname'] = $v->User->nickname;
                   $v['face'] = $v->User->face;
                   if( isset($uid) ){
                        $v['like_ta'] = Timelinelike::where('tid',$v['id'])->where('uid',$uid)->first();
                   }
                }
                echo json_encode($data);
            }else{
                echo json_encode(['msg'=>'error']);
            }
        }else if( $p = $request->input('p') && $num=$request->input('num') ){
            $p = $request->input('p');
            $data = Timeline::where('public',1)->offset(($p-1)*$num)->limit($num)->orderBy('created_at','desc')->get();
            if(!$data->isEmpty()){
                foreach ($data as $k => $v) {
                   $v['uid'] = $v->User->id;
                   $v['nickname'] = $v->User->nickname;
                   $v['face'] = $v->User->face;
                   if( isset($uid) ){
                        $v['like_ta'] = Timelinelike::where('tid',$v['id'])->where('uid',$uid)->first();
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
        if(!$request->filled('content')){
            echo 'empty';
        }else{
            //接收除了图片的其他东西
            $data = $request->except('profile');
            $timeline = new Timeline;
            //uid为session的id
            $timeline->uid = session('user')['id'];

            //内容
            $timeline->content = $data['content'];
            //判断是否为秘密
            if($data['cid'] == '秘密'){
                $timeline->public = 2;
            }else{
                $timeline->public = 1;
            }
            $cate = TimelineCate::where('name',$data['cid'])->first();
            //判断属于哪个标签
            if($data['cid'] != '添加标签'){ 
                //这条数据的cid
                $timeline->cid = $cate['id'];
                if($request->hasfile('profile')){
                    $image = $request->file('profile')->store('images');
                    $timeline->image = '/uploads/'.$image;
                    $res = $timeline->save();
                    if($res){
                        echo 'success';
                    }else{
                        echo 'Serror';
                    }     
                }else{
                    $res = $timeline->save();
                    if($res){
                        echo 'success';
                    }else{
                        echo 'Serror';
                    }
                }
            }else{
                $data['cid'] = null;
                if($request->hasfile('profile')){
                    $image = $request->file('profile')->store('images');
                    $timeline->image = '/uploads/'.$image;
                    $res = $timeline->save();
                    if($res){
                        echo 'success';
                    }else{
                        echo 'Serror';
                    }     
                }else{
                    $res = $timeline->save();
                    if($res){
                        echo 'success';
                    }else{
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
        //判断是否有session 并获取用户的id 往后来查是否有喜欢的碎片
        if( session('user') ){
            $uid = session('user')['id'];
        }
        if( isset($uid) ){
            $data['like_ta'] = Timelinelike::where('tid',$id)->where('uid',$uid)->first();
        }
        //查看用户评论的内容
        $comment = $data->Comment()->where('parent_id',0)->orderBy('created_at','desc')->get();
        $pinglun = $data->Comment()->count();
        if( !$comment->isEmpty()){
            foreach ($comment as $k => $v) {
                $v['children'] = TimeLineComment::where('parent_id',$v['id'])->orderBy('created_at','desc')->get();
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
        return view('home/Timeline/show',['data'=>$data,'comment'=>$comment,'cate'=>$cate,'likeness'=>$likeness,'pinglun'=>$pinglun]);
    }

    public function like(Request $request)
    {   
        DB::beginTransaction();
        $tid = $request->input('id');
        $uid = session('user')['id'];
        $res = TimelineLike::where('tid',$tid)->where('uid',$uid)->first();
        if(!$res){
            $timelineLike = new TimelineLike;
            $timelineLike->tid = $tid;
            $timelineLike->uid = $uid;
            $res1 = $timelineLike->save();
            $res2 = timeline::where('id',$tid)->increment('like');
            if( $res1 && $res2){
                DB::commit();
                echo 'success1';
            }else{
                DB::rollBack();
                echo 'error';
            }
        }else{
            $id = $res['id'];
            $res1 = Timelinelike::where('id',$id)->delete();
            $res2 = timeline::where('id',$tid)->decrement('like');
            if( $res1 && $res2){
                DB::commit();
                echo 'success2';
            }else{
                DB::rollBack();
                echo 'error';
            }
            
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
        $res1 = Timeline::where('id',$id)->delete();
        //判断是否有喜欢的记录
        if(TimelineLike::where('tid',$data['id'])->first()){
            $res2 = TimelineLike::where('tid',$id)->delete();
        }else{
            $res2 = true;
        }
        //判断是否有评论
        if(TimeLineComment::where('tid',$id)->first()){
            $res3 = TimeLineComment::where('tid',$id)->delete();
        }else{
            $res3 = true;
        }
        if( $res1 && $res2 && $res3 ){
            //判断是否有图片 
            if($data->image){
                $res4 = Storage::delete( ltrim($data->image,'/uploads/') );
            }else{
                $res4 = true;
            }

            if($res4){
                DB::commit();
                echo 'success';
            }else{
                DB::rollBack();
                echo 'error';
            }
        }else{
            DB::rollBack();
            echo 'error';
        }
        
    }
}
