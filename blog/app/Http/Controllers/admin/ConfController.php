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

        $WZ_title = Conf::where('name','title')->first();
        $logo = Conf::where('name','logo')->first();
        return view('admin/Conf/index',['title'=>'网站管理','WZ_title'=>$WZ_title,'logo'=>$logo]);
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

    public function title_store(Request $request)
    {
        $WZ_title = $request->only('title');
        $Conf = new Conf;
        $Conf->name = 'title';
        $Conf->content = $WZ_title['title'];
        $res = $Conf->save();
        if($res){
            return redirect('admin/Conf')->with('success','添加成功');
        }else{
            return back()->with('error','添加失败');
        }
    }

    public function title_update(Request $request)
    {   
        $title1 = $request->only('title');
        $data = Conf::where('name','title')->first();
        $data->content = $title1['title'];
        $res = $data->save();
        if($res){
             return redirect('admin/Conf')->with('success','修改成功');
        }else{
             return back()->with('error','修改失败');
        }
    }

    public function logo_store(Request $request)
    {   
        if( $request->hasFile('logo') ){
            $path = $request->file('logo')->store('images');
            if($path){
                $Conf = new Conf;
                $Conf->name = 'logo';
                $Conf->content = '/uploads/'.$path;
                $res = $Conf->save();
                if($res){
                    return redirect('admin/Conf')->with('success','添加成功');
                }else{
                    return back()->with('添加失败');
                } 
            }else{
                return back()->with('error','添加失败');
            }
        }else{
            return back()->with('error','请选择文件');
        }
        
    }

    public function logo_update(Request $request)
    {   
        if( $request->hasFile('logo') ){
            $path = $request->file('logo')->store('images');
            if( $path ){
                $Conf = Conf::where('name','logo')->first();
                $Conf->name = 'logo';
                $Conf->content = '/uploads/'.$path;
                $res = $Conf->save();
                if($res){
                    echo $path;
                }else{
                    echo 'error';
                } 
            }else{
                echo 'error';
            }
        }else{
            echo 'error';
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
