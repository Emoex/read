<?php

namespace App\Http\Controllers\home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\ArticleCate;
use App\models\Article;
use DB;
use App\models\ArticleComment;
class ArticleController extends Controller
{
    
    static protected function getComment($parent_id = 0,&$result = array())
    {       
        $arr = ArticleComment::where('parent_id',$parent_id)->orderBy('created_at', 'desc')->get();  
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $value) {  
            $thisArr = &$result[];
            $value["children"] = static::getComment($value["id"],$thisArr);    
            $thisArr = $value;                                    
        }
        return $result;
   }
   
    static protected function reply($children,$str)
        {  
           if(!empty($children['children'])){
             foreach($children->children as $k=>$v){
               $str .= "<div class='comment-content-others'>
                            <a href='../user/user.html?uid=4934695' target='_blank'>　{$v->uname}:</a>{$v->content}
                            <a class='comment-del report replySpan' onclick='dododo({$v->id},this);'>回复</a>
                            <span class='comment-del report' style='display: none;'>举报</span>
                            <span class='comment-del' style='display: none;'>删除</span>
                         </div>";
             }
             static::reply($children['children'],$str);
             
           }else{
             return $str;
           }   
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
        return view('home/article/index',['cate'=>$cate,'article'=>$article]);
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
        $article = Article::find($id);
        $comment = static::getComment();
        $s1 = '';
        $s2 = '';
        foreach ($comment as $k => $v) {
           $s1 .= static::reply($v,$s2); 
        }
        $num = ArticleComment::count();
        return view('home/article/article',['article'=>$article,'comment'=>$comment,'reply'=>$s1,'num'=>$num]);
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


    public function showCate($id)
    {
        $cate = ArticleCate::find($id);
        $article = Article::where('cid',$id)->get();
        return view('home/article/cate',['cate'=>$cate,'article'=>$article]);
    }
}
