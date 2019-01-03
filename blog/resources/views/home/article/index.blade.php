@extends('home/layout/index')
@section('content')
<div class="container">
     <!-- 轮播图 -->
    <div class="Cooldog_container">
        <div class="Cooldog_content">
            <ul>
                <li class="p1">
                    <a href="#">
                        <img src="/images/1.JPG" alt="">
                    </a>
                </li>
                <li class="p2">
                    <a href="#">
                        <img src="/images/2.JPG" alt="">
                    </a>
                </li>
                <li class="p3">
                    <a href="#">
                        <img src="/images/3.JPG" alt="">
                    </a>
                </li>
                <li class="p4">
                    <a href="#">
                        <img src="/images/4.JPG" alt="">
                    </a>
                </li>
                <li class="p5">
                    <a href="#">
                        <img src="/images/5.JPG" alt="">
                    </a>
                </li>
            </ul>
        </div>
        <a href="javascript:;" class="btn_left">
            <i class="iconfont icon-zuoyoujiantou"></i>
        </a>
        <a href="javascript:;" class="btn_right">
            <i class="iconfont icon-zuoyoujiantou-copy-copy"></i>
        </a>
        <a href="javascript:;" class="btn_close">
            <i class="iconfont icon-icon-test"></i>
        </a>
        <div class="buttons clearfix">
            <a href="javascript:;" class="color"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
            <a href="javascript:;"></a>
        </div>
    </div>

    
   <div class="index-content">
    <div class="article-type-group">
     <div class="title-cpt">
      分类&nbsp;|&nbsp;Classification
     </div> 
     @foreach($cate as $k=>$v)
     <div class="article-type-cpt">
      <a href="/home/article/cate/{{ $v->id }}"><img src="{{ $v->path }}" /><span class="type-bg"></span><span class="type-title">{{ $v->name }}</span><span class="type-des">Story/1061篇</span></a>
     </div>
     @endforeach
    </div> 
    <div class="article-list-group">
     <div class="title-cpt">
      热门文章&nbsp;|&nbsp;Hot Articles
     </div> 
     
     @foreach($article as $k=>$v)
     <div class="article-cpt article-cpt-noimg">
      <div class="article-info">
       <div class="article-info-box">
        <div class="article-title">
         <a href="/home/article/{{ $v->id }}">{{ $v->title }}</a>
        </div> 
        <div class="article-author">
         <a href="../user/user.html?uid=4325575" target="_blank">By&nbsp;/&nbsp;{{ $v->User->uname }}</a>
        </div> 
        <div class="article-content" style="overflow:hidden;line-height:18px">
           {{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}<span class="view-all"><a href="/home/article/{{ $v->id }}" target="_blank">VIEW ALL<img src="http://qnstatic.pianke.me/public/assets/img/viewall.png" /></a></span>  
         
        </div>
       </div> 
       <div class="article-others">
        {{ $v->look }}次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:182&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }} 
       </div>
      </div> 
      <div class="article-img" style="display: none;">
       <a href="/home/article/{{ $v->id }}" target="_blank"></a>
      </div>
     </div>
     @endforeach
     </div>
    </div> 
   </div>
  </div>
@endsection