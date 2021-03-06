<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\TingComment;
use App\Models\Report;
class TingCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $comment = new TingComment;
        $comment->tid = $request->tid;
        $comment->uid = session('user')['id'];
        $comment->content = $request->content;
        $comment->parent_id = $request->parent_id;
        $comment->like = 0;
        $res = $comment->save();
        $arr = [];
        if($res){
            $arr['id'] = $comment->id;
            $arr['uid'] = $comment->uid;
            $arr['uname'] = $comment->User->uname;
            $arr['nickname'] = $comment->User->nickname;
            $arr['face'] = $comment->User->face;
            $arr['time'] = $comment->created_at->format('Y-m-d H:i:s');
            $arr['like'] = $comment->like;
            $arr['content'] = $comment->content;
            $arr['msg'] = 'success';
        }else{
            $arr['msg'] = 'error';
        }
        echo json_encode($arr);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $tuid = $request->tuid;
        $uid = session('user')['id'];
        $comment = TingComment::find($id);
        if($tuid == $uid || $uid == $comment->uid){
             $report = Report::where('idid',$id)->where('table','ting_comment')->get();
             foreach ($report as $k => $v) {
                 $v->delete();
             }
             $children = TingComment::where('parent_id',$id)->get();
             foreach($children as $k => $v){
                $v->delete();
             }
             $res = $comment->delete();
             if($res){
                echo json_encode(['msg'=>'success']);
             }   
        }else{
          echo json_encode(['msg'=>'error']);  
        }
    }
}
