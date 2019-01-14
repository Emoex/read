<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Ting;
use App\Models\Timeline;
use App\Models\User;
use App\Models\Follow;
use DB;
class FeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        if(session('user')){
            $uid = session('user')['id'];
            $follow_id = Follow::where('uid',$uid)->get(['follow_user']);
            $ids = [];
            $ids[] = $uid;
            foreach($follow_id as $k=>$v){
                $ids[] = $v->follow_user;
            }
            $article = Article::whereIn('uid',$ids)->orderBy('created_at','desc')->get(); 
            $timeline = Timeline::whereIn('uid',$ids)->orderBy('created_at','desc')->get();
            $ting = Ting::whereIn('uid',$ids)->orderBy('created_at','desc')->get(); 

            foreach($article as $k=>$v){
                $data[] = $v;
            }
            foreach($timeline as $k=>$v){
                $data[] = $v;
            }
            foreach($ting as $k=>$v){
                $data[] = $v;
            }
            for($i = 0;$i<count($data);$i++){
                for($j = 0;$j<count($data)-1-$i;$j++){
                    if(strtotime(substr($data[$j]->created_at,0,10)) < strtotime(substr($data[$j+1]->created_at,0,10))){
                        $temp = $data[$j];
                        $data[$j] = $data[$j+1];
                        $data[$j+1] = $temp;
                    }
                }
            }
        }
       return view('home/feed/index',['data'=>$data]);

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
