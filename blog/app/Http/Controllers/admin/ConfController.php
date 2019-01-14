<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Config;
use App\Models\Conf;

class ConfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data = Conf::find(1);
        $data1 = Conf::find(2);
        $title1 = $data->content;
        $path = $data1->content;
        return view('admin/Conf/index',['title'=>'网站管理','title1'=>$title1,'path'=>$path]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function title_update(Request $request)
    {   
        $title1 = $request->only('title');
        $data = Conf::find(1);
        $data->content = $title1['title'];
        $res = $data->save();
        if($res){
             return redirect('admin/Conf')->with('success','修改成功');
        }else{
             return back()->with('error','修改失败');
        }
    }
    public function logo_update(Request $request)
    {   
        if($request->hasFile('logo')){
            $path = $request->file('logo')->store('images');
            if($path){
                $data = Conf::find(2);
                $data->content = $path;
                $res = $data->save();
                if($res){
                    echo $path;
                }else{
                    echo 'error';
                }
            }else{
                echo 'error';
            }
        }else{
            return back()->with('error','请选择文件');
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
        //
    }
}
