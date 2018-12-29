<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ting;
use App\Models\TingCate;
use DB;

class TingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ting=Ting::all();
        $listen=DB::select('select * from ting order by listen desc limit 3');
        $tingid=DB::select('select * from ting order by id desc limit 3');
        $like=DB::select('select * from ting order by likes desc limit 3');
        $cate=TingCate::all();
        return view('/home/ting/redio',['ting'=>$ting,'cate'=>$cate,'listen'=>$listen,'tingid'=>$tingid,'like'=>$like]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate=TingCate::all();
        return view('/home/ting/editor',['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ting=new Ting;
        $req=$request->except(['_token']);
        dump($req);
        if($request->hasFile('file')){
            $path = $request->file('file')->store('music');
            $ting->music='/uploads/'.$path;
        }
        if($request->hasFile('img')){
            $img = $request->file('img')->store('images');
            $ting->img='/uploads/'.$img;
        }
        $ting->title=$req['title'];
        $ting->cid=$req['cate'];
        $res=$ting->save();
        if($res){
            DB::commit();  //提交事务
            return redirect('/home/ting')->with('success','添加成功');
        }else{
            DB::rollBack();
            return redirect('error','添加失败');
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
        $info=Ting::find($id);
        return view('/home/ting/tinginfo',['info'=>$info]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $cate=TingCate::find($id);
        $ting=Ting::where('cid',$id)->get();
        $tcate=TingCate::all();
        return view('/home/ting/redioType',['cate'=>$cate,'ting'=>$ting,'tcate'=>$tcate]);
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
        //
    }
}
