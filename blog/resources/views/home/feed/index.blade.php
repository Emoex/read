@extends('home/layout/index')

@section('head')
  <link rel="stylesheet" type="text/css" href="/home/css/feed.css">
@endsection
@section('content')
<div class="container">
  <div class="title-cpt">最新动态&nbsp;&nbsp;|&nbsp;&nbsp;Lastest News</div>
  <div class="feed-container">

    @if(isset($data))
    @foreach($data as $k=>$v)
        @if($v->content && $v->title)
        <div class="feed-item">
          <div class="feed-user-info">
            <a href="{{ $v->uid }}" target="_blank">
              <img src="{{ $v->User->face }}"></a>
            <span class="user-name">
              <a href="/home/personal/{{ $v->uid }}" target="_blank">{{ $v->User->nickname or $v->User->uname }}</a></span>发布了一个文章
            <span class="time">{{ substr($v->created_at,0,10) }}</span></div>
          <div class="feed-contend feed-timeline">
            <div class="feed-user-name" style="">
              <a href="/home/article/{{ $v->id }}" target="_blank">{{ $v->title }}</a></div>
            <div class="timeline-content">
              <a href="/home/article/{{ $v->id }}" target="_blank"><div style="height:30px;overflow:hidden;text-overflow: ellipsis;white-space: nowrap;width: 50em;">{{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}</div></a></div>
           @if($v->image)   
            <div class="timeline-img">
              <a href="/home/article/{{ $v->id }}" target="_blank">
                <img src="{{ $v->image }}" width="100%"></a>
            </div>
            @endif
          <div class="feed-others">{{ $v->look }}次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }}
              <div class="feed-del" style="display: none;">
                <div class="del-btn">删除</div></div>
            </div>
          </div>
        </div>
        @elseif($v->content)
           <div class="feed-item">
                <div class="feed-user-info">
                  <a href="{{ $v->uid }}" target="_blank">
                    <img src="{{ $v->User->face }}"></a>
                  <span class="user-name">
                    <a href="/home/personal/{{ $v->uid }}" target="_blank">{{ $v->User->nickname or $v->User->uname }}</a></span>发布了一个碎片
                  <span class="time">{{ substr($v->created_at,0,10) }}</span></div>
                <div class="feed-contend feed-timeline">
                  <div class="timeline-content">
                    <a href="/home/timeline/{{ $v->id }}" target="_blank"><div style="height:30px;overflow:hidden;text-overflow: ellipsis;white-space: nowrap;width: 50em;">{{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}</div></a></div>
                 @if($v->image)   
                  <div class="timeline-img">
                    <a href="/home/timeline/{{ $v->id }}" target="_blank">
                      <img src="{{ $v->image }}" width="100%"></a>
                  </div>
                  @endif
                <div class="feed-others">{{ $v->look }}次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }}
                    <div class="feed-del" style="display: none;">
                      <div class="del-btn">删除</div></div>
                  </div>
                </div>
          </div>
        @else
            <div class="feed-item">
                <div class="feed-user-info">
                  <a href="{{ $v->uid }}" target="_blank">
                    <img src="{{ $v->User->face }}"></a>
                  <span class="user-name">
                    <a href="/home/personal/{{ $v->uid }}" target="_blank">{{ $v->User->nickname or $v->User->uname }}</a></span>发布了一个电台
                  <span class="time">{{ substr($v->created_at,0,10) }}</span></div>
                <div class="feed-contend feed-timeline">
                  <div class="feed-user-name" style="">
                    <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a></div>
                 @if($v->img)   
                  <div class="timeline-img">
                    <a href="/home/ting/{{ $v->id }}" target="_blank">
                      <img src="{{ $v->img }}" width="100%"></a>
                  </div>
                  @endif
                <div class="feed-others">{{ $v->look }}次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }}
                    <div class="feed-del" style="display: none;">
                      <div class="del-btn">删除</div></div>
                  </div>
                </div>
          </div>
        @endif    
    @endforeach
  @endif  
  </div>
  <div class="loading" style="display: none;"></div>
  <div class="no-more-data" style="display: none;">-&nbsp;已加载全部&nbsp;-</div></div>
@endsection