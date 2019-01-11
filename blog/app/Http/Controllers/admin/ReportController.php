<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Report;
use App\models\Article;
use App\models\ArticleComment;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::paginate(3);
        foreach($reports as $k=>$v){
            switch($v->table){
               case 'article': 
               $v->table = '文章';
               $v->content = Article::find($v->idid)->content;break;
               case 'article_comment':
                $v->table = '文章评论';
                $v->content = ArticleComment::find($v->idid)->content;break;
            }
        }
        return view('admin/report/index',['reports'=>$reports]);
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
         $report = Report::find($id);
         $temp = $request->temp;
         if($temp == 1){
            $report->status = 2;
            $res = $report->save();
            if($res){
                echo 'agree';
            }
         }else{
            $report->status = 3;
            $res = $report->save();
            if($res){
                echo 'disagree';
            }
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
        $report = Report::find($id);
        $res = $report->delete();
        if($res){
            echo 'success';
        }else{
            echo 'error';
        }
    }
}
