<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ArticleCate;
use App\models\Article;
use DB;
use App\models\ArticleComment;
use App\models\ArticleLike;
class ArticleController extends Controller
{
    
    static protected function getComment($aid = 0,$parent_id = 0,&$result = array())
    {       
        $arr = ArticleComment::where('parent_id',$parent_id)->where('aid',$aid)->orderBy('created_at', 'desc')->get();  
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $value) {  
            $thisArr = &$result[];
            $value["children"] = static::getComment($aid,$value["id"],$thisArr);    
            $thisArr = $value;                                    
        }
        return $result;
   }
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cate = ArticleCate::get();
        $article = Article::orderBy('look','desc')->paginate(3);
        $active = 1;
        return view('home/article/index',['cate'=>$cate,'article'=>$article,'active'=>$active]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cate = ArticleCate::get();
        return view('home/article/create',['cate'=>$cate]);
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
        $article = Article::find($id);
        $comment = static::getComment($id);
        $num = ArticleComment::where('aid',$id)->count();
        $active = 1;
        return view('home/article/article',['article'=>$article,'comment'=>$comment,'num'=>$num,'active'=>$active]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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

    /**
     * 显示指定类别的文章
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function showCate(Request $request,$id)
    {
        $p = $request->input('p',1);
        $num = $request->input('num',3);
        $cate = ArticleCate::find($id);
        $active = 1;
        $sum = Article::where('cid',$id)->count();
        $article = Article::where('cid',$id)->offset(($p-1)*$num)->limit($num)->get();
        return view('home/article/cate',['cate'=>$cate,'article'=>$article,'active'=>1,'sum'=>$sum]);
    }

    /**
     * 文章瀑布流
     * @param  Request $request [description]
     * @param  [type]  $id      [description]
     * @return [type]           [description]
     */
    public function pinterest(Request $request)
    {
        $p = $request->input('p',2);
        $num = $request->input('num',3);
        $id = $request->input('id',6);
        $article = Article::where('cid',$id)->offset(($p-1)*$num)->limit($num)->get();
        foreach($article as $k=>$v){
            $v->uid = $v->User->id;
            $v->nickname = $v->User->nickname;
        }
        if($article){
            echo json_encode($article);
        }else{
            echo json_encode(['msg'=>'error']);
        }
    }

    public function look(Request $request)
    {
        $article = Article::find($request->aid);
        $article->look = $article->look + 1;
        $res = $article->save();
        if($res){
            echo json_encode(['look'=>$article->look]);
        }else{
            echo json_encode(['msg'=>'error']);
        }
    }

    public function like(Request $request)
    {
        $like = ArticleLike::where('aid',(int)$request->aid)->where('uid',session('user')['id'])->first();
        if(empty($like->aid)){
                $article = Article::find($request->aid);
                $article->like = $article->like + 1;
                $res = $article->save();
                if($res){
                    $like = new ArticleLike;
                    $like->aid = $request->aid;
                    $like->uid = session('user')['id'];
                    $like->save();
                    echo json_encode(['like'=>$article->like]);
                }
            }else{
                   echo json_encode(['msg'=>'error']);
          }
    }

}
