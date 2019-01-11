<?php

namespace App\Http\Controllers\admin;

use App\Models\admin\timeline;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\timelineStore;
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
        $data = timeline::get();
        return view('admin/Timeline/index',['title'=>'碎片管理','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/Timeline/create',['title'=>'添加碎片']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(timelineStore $request)
    {   
        $data = $request->except(['_token','profile']);
        if($request->hasFile('profile')){
            $image = $request->file('profile')->store('images');
            $data['image'] = $image;
        }
        $data['uid'] = 1;
        $data['time'] = date('Y-m-d H:i:s',time());
        $res = timeline::insert($data);
        if($res){
            return redirect('admin/timeline/create')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
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
        $data = timeline::find($id);
        $image = $data['image'];
        $res = timeline::where('id',$id)->delete();
        if($res){
            Storage::delete($image);
            echo 'success';exit;
        }else{
            echo 'error';exit;
        }
    }
}
