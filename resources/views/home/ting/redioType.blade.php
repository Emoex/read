@extends('home/layout/index')
@section('content')

<div class="container">
    <div class="index-content">
     <div class="radio-type-info">
      <div class="radio-type-img" style="width: 196px;height:196px;border-radius: 100%;margin:auto;border:1px solid #333;color: #333">
       <img src="{{ $cate->path }}" style="width:50px;height:50px;border:1px solid #000;margin-top:55px" />
       <div style="font-size: 15px;letter-spacing:3px;margin-top:5px;">{{ $cate->name }}</div>
      </div> 
      <div class="radio-types">
       <div class="radio-type-link">
         分类: 
         @foreach($tcate as $k=>$v)
        <a href="/home/ting/{{ $v->id }}/edit" class="">{{ $v->name }}</a> 
        @endforeach
       </div>
      </div>
     </div> 
     @foreach($ting as $k=>$v)
     <div class="ting-list-group" style="margin:auto;">
      <div class="ting-list ting-type-list">
       <div class="ting-cpt">
        <div class="ting-img">
         <a href="/home/ting/{{ $v->id }}" target="_blank"><img src="{{ $v->img }}" class="lazy loaded" /><span></span></a>
        </div>       
        <div class="ting-info">
         <div class="ting-title">
          <a href="/home/ting/{{ $v->id }}" target="_blank">{{$v->title}}</a>
         </div> 
         <div class="ting-author">
          <a href="../user/user.html?uid=3956846" target="_blank">主播&nbsp;/&nbsp;{{ $v->tname }}</a>
         </div> 
         <div class="ting-others">
          {{ $v->listen }}k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:9&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }}
         </div>
        </div>
        
       </div> 
       @endforeach
       <div class="loading" style="display: none;"></div> 
       <div class="no-more-data" style="display: none;">
        -&nbsp;已加载全部&nbsp;-
       </div>
      </div>
     </div>
    </div>
   </div> 
   <div class="back-top"></div> 

@endsection('content')