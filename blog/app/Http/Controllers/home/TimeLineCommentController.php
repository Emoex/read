<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TimeLineComment;
use App\MOdels\User;
use App\models\Report;
class TimeLineCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if( !$request->filled('content') ){
            echo json_encode(['msg'=>'empty']);exit;
        }else{
            $data = $request->all();
            $data['uid'] = session('user')['id'];
            $data['time'] = date('Y-m-d H:i:s',time());
            $id = TimeLineComment::insertGetId($data);
            if($id){
                $user = User::where('id',$data['uid'])->first();
                $data['id'] = $id;
                $data['nickname'] = $user['nickname'];
                $data['face'] = $user['face'];
                echo json_encode($data);exit;
            }else{
                echo json_encode(['msg'=>'error']);exit;
            }
        }
    }

    public function huifu(Request $request)
    {   
        if( !$request->filled('content') ){
            echo json_encode(['msg'=>'empty']);
        }else{
            $data['content'] = $request->input('content');
            $data['tid'] = $request->input('tid');
            $data['parent_id'] = $request->input('parent_id');
            $data['uid'] = session('user')['id'];
            $data['time'] = date('Y-m-d H:i:s',time());
            $id = TimeLineComment::insertGetId($data);
            if($id){
                $data['id'] = $id;
                $user = User::where('id',$data['uid'])->first();
                $data['nickname'] = $user['nickname'];
                echo json_encode($data);exit;
            }else{
                echo json_encode(['msg'=>'error']);
            }

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
        $res = TimeLineComment::where('id',$id)->orwhere('parent_id',$id)->delete();
        $report = Report::where('idid',$id)->where('table','timeline_comment')->get();
             foreach ($report as $k => $v) {
                 $v->delete();
        }
        if( $res ){
            echo json_encode(['msg'=>$res]);
        }else{
            echo json_encode(['msg'=>$res]);
        }
    }
}
