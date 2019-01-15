<?php

namespace App\Http\Controllers\admin;

use App\Models\timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\timelineStore;
use Illuminate\Support\Facades\Storage;
use App\Models\TimelineCate;
use App\models\Report;
use App\models\TimelineComment;
use App\models\TimelineLike;
use DB;

class TimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $data = timeline::orderBy('created_at','desc')->get();
        return view('admin/Timeline/index',['title'=>'碎片管理','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $cate = TimelineCate::get();
        return view('admin/Timeline/create',['title'=>'添加碎片','cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {   
        $data = $request->except(['_token','profile']);
        if( $data['content'] ){
            $timeline = new timeline;
            $timeline->cid = $data['cid'];
            $timeline->content = $data['content'];
            $timeline->public = $data['public'];
            $timeline->uid = session('user')['id'];
            if($request->hasFile('profile')){
                $image = $request->file('profile')->store('images');
                $timeline->image = '/uploads/'.$image;
            }
            $res = $timeline->save();
            if($res){
                return redirect('admin/timeline/create')->with('success','添加成功');
            }else{
                return back()->with('error','添加失败');
            }
        }else{
            return back()->with('error','请填写内容');
        }
        
    }

    public function profile(Request $request)
    {
        $profile = $request->file('profile');
        $ext = $profile->extension();
        $path = '1'.'.'.$ext;
        $res = $profile->storeAs('images',$path);
        if($res){
            echo $res;
            exit;
        }else{
            echo 'error';
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $data = timeline::find($id);
        return view('admin/Timeline/show',['title'=>'碎片内容','data'=>$data]);
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
        $data = timeline::find($id);
        $res1 = Timeline::where('id',$id)->delete();
        //判断是否有喜欢的记录
        if(TimelineLike::where('tid',$data['id'])->first()){
            $res2 = TimelineLike::where('tid',$id)->delete();
        }else{
            $res2 = true;
        }
        //判断举报记录
        if(Report::where('idid',$id)->where('table','timeline')->orwhere('table','timeline_comment')->first()){
            $res3 = Report::where('idid',$id)->where('table','timeline')->orwhere('table','timeline_comment')->delete();
        }else{
            $res3 = true; 
        } 
        //判断是否有评论
        if(TimeLineComment::where('tid',$id)->first()){
            $res4 = TimeLineComment::where('tid',$id)->delete();
        }else{
            $res4 = true;
        }
        if( $res1 && $res2 && $res3 && $res4){
            //判断是否有图片 
            if($data->image){
                $res5 = Storage::delete( ltrim($data->image,'/uploads/') );
            }else{
                $res5 = true;
            }
            if($res5){
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
