@extends('home/layout/index')
@section('content')

<div class="container">
    <div class="focus-picture">
     <div class="">
      <a href="/pages/read/articleInfo.html?id=5a66d52f257be99e1d64c5da" target="_blank"><img src="http://hpimg.pianke.com/2bc9aa39ea47b28e3477096514667cae20180814.jpg?imageView2/2/w/640/format/jpg" /> <span class="article-focus-bg"></span> <span class="article-focus-title">杀掉一个无人际关系的人</span></a>
     </div>
     <div class="">
      <a href="/pages/read/articleInfo.html?id=5b725b83257be94b69cf8962" target="_blank"><img src="http://hpimg.pianke.com/01a158910150133149221cfef791e0b220180814.jpg?imageView2/2/w/640/format/jpg" /> <span class="article-focus-bg"></span> <span class="article-focus-title">我想要一个无条件站在我身边的人。</span></a>
     </div>
     <div class="">
      <a href="/pages/read/articleInfo.html?id=5b69832a257be98714cf8962" target="_blank"><img src="http://hpimg.pianke.com/6c4d64457db904a94057bc4c3a5859ed20180814.jpg?imageView2/2/w/640/format/jpg" /> <span class="article-focus-bg"></span> <span class="article-focus-title">我的女朋友是借来的，最后我把她弄丢了</span></a>
     </div>
     <div class="">
      <a href="/pages/read/articleInfo.html?id=5a4c3c2a4cfcf3927b84d9c5" target="_blank"><img src="http://hpimg.pianke.com/1045d95381b0b09d765e5e3f7a74545120180814.jpg?imageView2/2/w/640/format/jpg" /> <span class="article-focus-bg"></span> <span class="article-focus-title">此身越重洋，此生多勉强</span></a>
     </div>
     <div class="">
      <a href="/pages/read/articleInfo.html?id=5982e7c6a581a338372a3d48" target="_blank"><img src="http://hpimg.pianke.com/25c4460266d120ed5536c854a84e8ea620171012.jpg?imageView2/2/w/640/format/jpg" /> <span class="article-focus-bg"></span> <span class="article-focus-title">坚持绘画147天，这些意想不到的事情发生了</span></a>
     </div>
    </div> 
    <div class="index-content">
    
      <div class="article-list-group">
      <div class="title-cpt">
       阅读&nbsp;|&nbsp;Read
      </div> 
      <div class="article-cpt">
       <div class="article-info">
        <div class="article-info-box">
         <div class="article-title">
          <a href="../../pages/read/articleInfo.html?id=5a236c3f4cfcf3177384d9c9" target="_blank">年华</a>
         </div> 
         <div class="article-author">
          <a href="../../pages/user/user.html?uid=119707" target="_blank">By&nbsp;/&nbsp;盗梦的益安</a>
         </div> 
         <div class="article-content">
           1。再结婚一次，当下的安稳。只拍一组白纱做纪念。怀孕已三月，也不见胖，涨点年纪是韵味，挽着G先生的手，不输那些年轻男女。到这个年纪再婚，条件不用列举彼此心里都有 
          <span class="view-all"><a href="../../pages/read/articleInfo.html?id=5a236c3f4cfcf3177384d9c9" target="_blank">VIEW ALL<img src="http://qnstatic.pianke.me/public/assets/img/viewall.png" /></a></span>
         </div>
        </div> 
        <div class="article-others">
         8.8 k次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:59&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:129 
        </div>
       </div> 
       <div class="article-img" style="background-image: url(&quot;http://hpimg.pianke.com/92a75c703093606dc4c0f14f7484563620170426.jpg?imageView2/2/w/640/format/jpg&quot;);">
        <a href="../../pages/read/articleInfo.html?id=5a236c3f4cfcf3177384d9c9" target="_blank"></a>
       </div>
      </div>
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
          <a href="../../pages/user/user.html?uid=145858" target="_blank">主播&nbsp;/&nbsp;{{ $v->tname }}</a>
         </div> 
         <div class="ting-others">
          {{ $v->listen }}k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:50&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->likes }} 
         </div>
        </div>
       </div>
       @endforeach
      </div>
     </div>      <!-- 阅读 -->
     


     <div class="user-list-group">
      <div class="title-cpt">
       人气片客&nbsp;|&nbsp;Hot Pianker
      </div> 
      <div class="user-list">
       <div class="user-cpt">
        <div class="user-info">
         <div class="user-cpt-left">
          <a href="/pages/user/user.html?uid=4044800" target="_blank"><img src="http://tva2.sinaimg.cn/crop.0.0.996.996.50/ec39c62fjw8f6ddod449ij20ro0rp0vb.jpg" /></a> 
          <img src="../../public/assets/img/user_musician.png" />
         </div> 
         <div class="user-cpt-right">
          <div class="user-name">
           <a href="/pages/user/user.html?uid=4044800" target="_blank">双笙子</a>
          </div> 
          <div class="user-des">
           古风歌手双笙
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div> 



    <div class="more-botton">
     <div class="btn-box">
      <div class="btn btn-more">
       查看更多精选内容
      </div>
     </div>
    </div> 
    <div class="more-content" style="">
     <div class="past-content-title">
      <div class="title-cpt">
       往期精选
      </div>
     </div> 
     <div class="img-group-cpt" style="height: 200px;"></div> 
     <div class="no-more-data" style="">
      -&nbsp;已加载全部&nbsp;-
     </div> 
     <div class="loading" style=""></div>
    </div>
   </div> 
   <div class="back-top"></div> 


@endsection('content')