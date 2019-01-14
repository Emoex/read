<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Follow;
use App\Models\Article;
use App\Models\Ting;
use App\Models\Timeline;
use App\Models\ArticleComment;
class PersonalController extends Controller
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
        if(session('user')){
        $user = User::find($id);
        $status = Follow::where('uid',session('user')['id'])->where('follow_user',$id)->get();
        if($status->isEmpty()){
            $status = 'no';
        }else{
            $status = 'yes';   
        }
 
        $follow = Follow::where('uid',$id)->get();          
        $fans = Follow::where('follow_user',$id)->get();  
        foreach ($follow as $k => $v) {
             $fo = Follow::where('uid',session('user')['id'])->where('follow_user',$v->follow_user)->first();
             $fa = Follow::where('uid',$v->follow_user)->where('follow_user',session('user')['id'])->first();
             if($fo && $fa){
                $v->status = 3;
             }else if($fo){
                $v->status = 2;
             }else{
                $v->status = 1;
             }
         }
         foreach ($fans as $k => $v) {
             $fo = Follow::where('uid',session('user')['id'])->where('follow_user',$v->uid)->first();
             $fa = Follow::where('uid',$v->uid)->where('follow_user',session('user')['id'])->first();
             if($fo && $fa){
                $v->status = 3;
             }else if($fo){
                $v->status = 2;
             }else{
                $v->status = 1;
             }
         }  
        $follow_num = Follow::where('uid',$id)->count();
        $fans_num = Follow::where('follow_user',$id)->count();
        $article = Article::where('uid',$id)->offset(0)->limit(5)->get();
        $ting = Ting::where('uid',$id)->offset(0)->limit(5)->get();
        $timeline = Timeline::where('uid',$id)->offset(0)->limit(5)->get();
        foreach($article as $k=>$v){
            $v->comment = ArticleComment::where('aid',$v->id)->count();
        }
        
        $article_num = Article::where('uid',$id)->count();
        $ting_num = Ting::where('uid',$id)->count();
        $timeline_num = Timeline::where('uid',$id)->count();

        $article_comment = ArticleComment::where('uid',session('user')['id'])->get();
        $pid = [];
        foreach($article_comment as $k=>$v){
            $pid[] = $v->id;
        }
        $comment_info = ArticleComment::whereIn('parent_id',$pid)->orderBy('created_at','desc')->get();
        $comment_num = ArticleComment::whereIn('parent_id',$pid)->orderBy('created_at','desc')->count();

        return view('home/personal/index',[
            'user'=>$user,'status'=>$status,'follow_num'=>$follow_num,
            'fans_num'=>$fans_num,'article'=>$article,'article_num'=>$article_num,
            'ting'=>$ting,'timeline'=>$timeline,'ting_num'=>$ting_num,
            'timeline_num'=>$timeline_num,'follow'=>$follow,'fans'=>$fans,
            'comment_info'=>$comment_info,'comment_num'=>$comment_num,
            
            ]);
        }

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

    public function pinterest(Request $request)
    {
        $index = $request->input('index',0);
        $id = $request->id;
        $p = $request->input('p',2);
         $num = $request->input('num',5);
        switch($index){
         case 0 :
                $article = Article::where('uid',$id)->offset(($p-1)*$num)->limit($num)->get();
                if(!$article->isEmpty()){
                    echo json_encode($article);
                }else{
                    echo json_encode(['msg'=>'error']);
                } 
                break;
         case 1 :
                $timeline = Timeline::where('uid',$id)->offset(($p-1)*$num)->limit($num)->get();
                if(!$timeline->isEmpty()){
                    echo json_encode($timeline);
                }else{
                    echo json_encode(['msg'=>'error']);
                } 
                break;
        case 2 :
                $ting = Ting::where('uid',$id)->offset(($p-1)*$num)->limit($num)->get();
                if(!$ting->isEmpty()){
                    echo json_encode($ting);
                }else{
                    echo json_encode(['msg'=>'error']);
                } 
                break;      
        }


    }
}
