<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conf;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Conf::where('name','Slide')->get();
        return view('admin/Conf/Slide/index',['title'=>'轮播图管理','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin/Conf/Slide/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if( $request->hasfile('content') ){
            $path = $request->file('content')->store('images');
            if($path){
                $Conf = new Conf;
                $Conf->name = 'Slide';
                $Conf->content = $path;
                $res = $Conf->save();
                if($res){
                    return redirect('admin/Conf/Slide')->with('success','添加成功');
                }else{
                    return back()->with('error','添加失败');
                }
            }else{
                return back()->with('error','添加失败');
            }     
        }else{
            return back()->with('error','请选择图片');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Conf::find($id);
        return view('admin/Conf/Slide/edit',['title'=>'轮播图修改','data'=>$data]);
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
        if( $request->hasfile('content') ){
            $path = $request->file('content')->store('images');
            $res = Conf::where('id',$id)->update(['content'=>$path]);
            if($res){
                return redirect('admin/Conf/Slide')->with('success','修改成功');
            }else{
                return back()->with('error','修改失败');
            }
        }else{
            return back()->with('error','请选择图片');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $path = Conf::find($id)['content'];
        $res = Conf::where('id',$id)->delete();
        if($res){
            $res1 = Storage::delete($path);
            if($res1){
                return redirect('admin/Conf/Slide')->with('success','删除成功');
            }else{
                return back()->with('error','删除失败');
            }
        }else{
            return back()->with('error','删除失败');
        }

    }
}
