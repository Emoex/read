@extends('home/layout/index')
@section('head')
<link rel="stylesheet" href="/css/index.css" />
@endsection
@section('content')

<div class="container">
    <div class="focus-picture">
    @foreach($articleq as $k=>$v)
     <div class="">
      <a href="/home/article/{{$v->id}}" target="_blank"><img src="{{ $v->image }}" /> <span class="article-focus-bg"></span> <span class="article-focus-title">{{ $v->title }}</span></a>
     </div>
     @endforeach
    </div> 
    
    <div class="index-content">   
      <div class="article-list-group">
      <div class="title-cpt" >
       阅读&nbsp;|&nbsp;Read
      </div> 
      @foreach($article as $k=>$v)
      <div class="article-cpt" >
       <div class="article-info" style="width:100%;">
        <div class="article-info-box">
         <div class="article-title">
          <a href="/home/article/{{ $v->id }}" target="_blank">{{ $v->title }}</a>
         </div> 
         <div class="article-author">
          <a href="../../pages/user/user.html?uid=119707" target="_blank">By&nbsp;/&nbsp;{{ $v->User->nickname }}</a>
         </div> 
         <div class="article-content" style="line-height: 22px">
           {{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}
          <span class="view-all"><a href="/home/article/{{ $v->id }}" target="_blank">VIEW ALL<img src="http://qnstatic.pianke.me/public/assets/img/viewall.png" /></a></span>
         </div>
        </div> 
        <div class="article-others">
         {{ $v->look }}k次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:59&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }} 
        </div>
       </div> 
      </div>
      @endforeach
     </div> 


     <div class="ting-list-group">
      <div class="title-cpt">
       TING
      </div> 
      <div class="ting-list">
      @foreach($tingid as $k=>$v)
       <div class="ting-cpt">
        <div class="ting-img">
         <a href="/home/ting/{{ $v->id }}" target="_blank"><img src="{{ $v->img }}" /><span></span></a>
        </div> 
        <div class="ting-info">
         <div class="ting-title">
          <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a>
         </div> 
         <div class="ting-author">
          <a href="../../pages/user/user.html?uid=145858" target="_blank">主播&nbsp;/&nbsp;{{ $v->User->nickname }}</a>
         </div> 
         <div class="ting-others">
          {{ $v->listen }}次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:50&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->likes }} 
         </div>
        </div>
       </div>
       @endforeach
      </div>
     </div>  
    </div> 


</div>
@endsection('content')