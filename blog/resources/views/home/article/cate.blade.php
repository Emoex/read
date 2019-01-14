@extends('home/layout/index')
@section('head')
    <link rel="stylesheet" type="text/css" href="/home/css/read.css">
@endsection
@section('content')
 <div class="container">
   <div class="index-content">
    <div class="article-type-info" style="background-image: url(&quot;{{ $cate->path }}&quot;);">
     <span></span> 
     <div class="article-type-title">
      {{ $cate->name }}
     </div> 
     <div class="article-type-others">
      Story&nbsp;/&nbsp;{{ $sum }}篇文章
     </div> 
    </div> 
    <div class="type-title-cpt">
     <span class="active">HOT</span> 
     <span class="">NEW</span>
    </div> 



    @foreach($article as $k=>$v)
     <div class="article-cpt article-cpt-noimg">
      <div class="article-info">
       <div class="article-info-box">
        <div class="article-title">
         <a href="/home/article/{{ $v->id }}" target="_blank" id="title">{{ $v->title }}</a>
        </div> 
        <div class="article-author">
         <a href="/home/personal/{{ $v->User->id }}" target="_blank" id="uname">By&nbsp;/&nbsp;{{ $v->User->nickname }}</a>
        </div> 
        <div class="article-content">
          {{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}
        </div>
       </div> 
       <div class="article-others">
        {{ $v->look }}次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }} 
       </div>
      </div> 
      <div class="article-img" style="display: none;">
       <a href="./articleInfo.html?id=5c258fa2257be9c54a60ce61" target="_blank"></a>
      </div>
     </div>
     @endforeach

     <div class="no-more-data" style="display: none;">
      -&nbsp;已加载全部&nbsp;-
     </div> 
     <div class="loading" style="display: none;"></div>
    </div>

   </div>
  </div>

{{ csrf_field() }}
<input type="hidden" name="cid" value="{{ $cate->id }}">
  <script>
    $(function(){
    // 当前页面
    var p = 2;
    // 条数
    var num = 3;
    // 标识符
    var isLoad = false;
    getArticles();
    function getArticles()
    {
      $.post('/home/article/pinterest',{'p':p,'num':num,'_token':$('input[name=_token]').val(),'id':$('input[name=cid]').val()},function(data){
          if(data.msg != 'error'){
            $.each(data,function(key,val){
              // 克隆div
              var temp = $('.article-cpt').eq(0).clone(true);
              var preg = /<\/?.+?\/?>/g;
              // 修div中内容
              temp.find('#title').eq(0).attr('href','/home/article/'+val.id);
              temp.find('#title').eq(0).html(val.title);
              temp.find('#uname').eq(0).attr('href','/home/personal/'+val.uid);
              temp.find('#uname').eq(0).html('By&nbsp;/&nbsp;'+val.nickname);
              temp.find('.article-content').eq(0).html(val.content.replace(preg,''));
              temp.find('.article-others').eq(0).html(val.look+"次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:"+val.like+" ");
              // 追加到内容
              $('.no-more-data').before(temp);
            });
            p++;
            isLoad = false;
          }else{
            // $('.no-more-data').css('display','block');
          }
        },'json');
    }


    // 当前页面滚动的加载数据
    $(window).scroll(function(){
      if(isLoad) return;
      // 全文高度
      var documentHeight = $(document).height();
      // 窗口高度
      var widthHeight = $(window).height();
      // 滚动高度
      var scrollHeight = $(window).scrollTop();
      // 计算底部距离
      var bottomHeight = documentHeight - widthHeight - scrollHeight;
      if(bottomHeight <= 50){
        isLoad = true;
        getArticles();
      }
    });


  });

  </script>
@endsection