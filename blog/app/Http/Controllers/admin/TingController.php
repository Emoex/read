<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TingStore;
use App\Models\Ting;
use App\Models\TingCate;
use App\Models\User;
use App\Models\Article;
use DB;
use App\models\TingComment;
use Illuminate\Support\Facades\Storage;
use App\models\Report;
class TingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $req=$request->all();
        $condition=[];
        if(!empty($req['content'])){
            $condition[]=['uname','like','%'.$req['content'].'%'];
        }
        $data=Ting::where($condition)->paginate(3);
        return view('/admin/ting/index',['title'=>'电台列表','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $article=Article::all();
        $user=User::all();
        $tingcate=TingCate::all();
        return view('/admin/ting/create',['title'=>'添加电台','tingcate'=>$tingcate,'user'=>$user,'article'=>$article]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqs=$request->except(['_token']);
        DB::beginTransaction();
        $ting=new Ting;
        $ting->title=$reqs['title'];
        $ting->uid=$reqs['uid'];
        $ting->aid=$reqs['aid'];
        $ting->cid=$reqs['cid'];
        if($request->hasFile('img')){
            $path = $request->file('img')->store('images');
            $ting->img='/uploads/'.$path;
        }
        if($request->hasFile('music')){
            $music = $request->file('music')->store('music');
            $ting->music='/uploads/'.$music;
        }
        $res=$ting->save();
        if($res){
            DB::commit();  //提交事务
            return redirect('/admin/ting')->with('success','添加成功');
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
        $article=Article::all();
        $tingcate=TingCate::all();
        $data=Ting::find($id);
        return view('/admin/ting/edit',['title'=>'修改电台','data'=>$data,'tingcate'=>$tingcate,'article'=>$article]);
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
        DB::beginTransaction();
        $data=$request->except(['_token']);
        $ting=Ting::find($id);
        $ting->title=$data['title'];
        if($request->hasFile('img')){
            $path = $request->file('img')->store('images');
            $ting->img='/uploads/'.$path;
        }
        if($request->hasFile('music')){
            $music = $request->file('music')->store('music');
            $ting->music='/uploads/'.$music;
        }
        $ting->cid=$data['tingcate'];
        $ting->aid=$data['aid'];
        $res=$ting->save();
        if($res){
            DB::commit();  //提交事务
            return redirect('/admin/ting')->with('success','修改成功');
        }else{
            DB::rollBack();
            return redirect('error','修改失败');
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
        $ting = Ting::find($id);
        $ting_comment = TingComment::where('tid',$id)->get();
        if($ting->img){
        $res = Storage::delete(ltrim($ting->img,'/uploads/'));
     }
       foreach($ting_comment as $k=>$v){
            $temp = $v->id;
            $report = Report::where('idid',$temp)->where('table','ting_comment')->get();
            foreach ($report as $kk => $vv) {
                 $vv->delete();
             }
            $v->delete();
        }
        $report = Report::where('idid',$id)->where('table','ting')->get();
         foreach ($report as $k => $v) {
             $v->delete();
         }
        $res = $ting->delete();
        DB::beginTransaction();
        if($res){
            DB::commit();  //提交事务
            echo 'success';exit;
        }else{
            DB::rollBack();
            echo 'error';exit;
        }
    }
}
