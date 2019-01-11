@extends('home/layout/index')

@section('head')
	<link rel="stylesheet" type="text/css" href="/home/css/timeline.css">
@endsection

@section('content')
  <div style="height: 100%" class="m-timelineInfo-container">
   <div class="container">
    <div class="timeline-container">
     <audio id="audiosrc" src="">
      您的浏览器不支持 audio 标签。
     </audio> 
     <div class="left-content">
    	<div class="timeline-author">
       <a href="../user/user.html?uid=4408715" target="_blank" class=""><img src="http://hpimg.pianke.com/cf6b447632d3f12ab276579bdfa04ee720181025.png?imageView2/2/w/90/format/jpg" /></a> 
       <a href="../user/user.html?uid=4408715" target="_blank" class="">urnotcha</a> 
       <div>
        {{ $data->time }}
        <div style="display: none;">
         <div class="del-btn">
          删除
         </div>
        </div> 
        <div>
         <div class="del-btn">
          举报
         </div>
        </div>
       </div>
      </div>
      @if( $data->image )  
      <img width="100%" style="" src="{{ $data->image }}" />
      @endif 
      <div class="timeline-content">
        {{ $data->content }} 
      </div> 
      <div class="timeline-voice-content" style="display: none;">
       <div class="voice-btn"></div> 
       <div id="timeline-voice">
        <canvas width="280" height="60" style="width: 280px; height: 60px;"></canvas>
       </div> 0’’ 
      </div> 
      <div class="timeline-tag" style="display: none;">
       <a href="./timeline.html?tag=" target="_blank">#&nbsp;&nbsp;#</a>
      </div> 
      <div class="handles">
       <div class="likes-cpt">
         0 
       </div> 
       <div class="share-cpt">
        <div class="share-sina"></div> 
        <div class="share-wechat">
         <div class="code">
          <img width="200" src="http://api5.pianke.me/version5.0/wxshare/qrcode.php?url=http%3A%2F%2Fpianke.me%2Fversion4.0%2Fweixin02%2Fwxshare.php%23!%2Ftimeline%2F5c2eb68b257be9626160ce60" />
         </div>
        </div> 
        <div class="share-qzone"></div> 
        <div class="share-dou"></div>
       </div>
      </div> 
      <div class="timeline-comment">
       <div class="is-login-cpt">
        <div class="if-no-login">
          快来
         <a class="btn">登录</a>发表你的精彩评论啦 
        </div> 
        <div class="is-login" style="display: none;">
         <textarea name="" id="" maxlength="360" placeholder="发表你的精彩评论啦"></textarea> 
         <div class="btn">
          发表评论
         </div>
        </div>
       </div> 
       <div class="article-comment">
        <div class="comment-title-cpt">
         <div>
          评论
          <span>(0&nbsp;条)</span>
         </div>
        </div> 
        <div class="comment-list-group"> 
         <div class="common-more-btn" style="display: none;">
          查看更多评论
         </div> 
         <div class="no-more-data" style="display: none;">
          -&nbsp;已加载全部&nbsp;-
         </div>
        </div> 
        <div class="no-comment" style="">
          暂时没有评论，快和小伙伴互动吧 
        </div>
       </div>
      </div>
     </div> 
     <div class="right-content">
      <div class="hot-tag">
       <div class="title-cpt">
        热门标签
       </div> 
       <div class="tag-list">
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E6%2582%2584%25E6%2582%2584%25E8%25AF%259D" target="_blank">悄悄话</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E6%2588%25B3%25E5%25BF%2583%25E6%25AD%258C%25E8%25AF%258D" target="_blank">戳心歌词</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E4%25B8%2580%25E8%25A7%2581%25E9%2592%259F%25E6%2583%2585%25E7%259A%2584%25E5%258F%25A5%25E5%25AD%2590" target="_blank">一见钟情的句子</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E7%2594%25B5%25E5%25BD%25B1%25E6%2588%25AA%25E5%259B%25BE%25EF%25BC%258B%25E7%25BB%258F%25E5%2585%25B8%25E5%258F%25B0%25E8%25AF%258D" target="_blank">电影截图＋经典台词</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E9%25BB%2591%25E7%2599%25BD%25E5%25A4%25A7%25E7%2589%2587" target="_blank">黑白大片</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E6%259C%2580%25E7%25BE%258E%25E6%2591%2598%25E6%258A%2584" target="_blank">最美摘抄</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E6%2597%25A7%25E4%25B9%25A6%25E6%2591%258A" target="_blank">旧书摊</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E7%259C%258B%25E7%2585%25A7%25E7%2589%2587%25E7%258C%259C%25E8%25BA%25AB%25E9%25AB%2598" target="_blank">看照片猜身高</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E4%25B8%2589%25E8%25A1%258C%25E6%2583%2585%25E4%25B9%25A6" target="_blank">三行情书</a>
        </div>
        <div class="btn-tag">
         <a href="./timeline.html?tag=%25E7%25BB%2599%25E5%258A%259B%25E5%25A4%25B4%25E5%2583%258F%25E9%2583%25BD%25E5%259C%25A8%25E8%25BF%2599" target="_blank">给力头像都在这</a>
        </div>
       </div>
      </div> 
      <div class="others-timeline">
       <div class="title-cpt">
        相关碎片
       </div> 
       <div class="img-group-cpt">
        <div class="card-timeline-cpt">
         <div class="card-top-img">
          <a href="./timelineInfo.html?id=5c2eb68b257be9626160ce60" target="_blank"><img src="http://hpimg.pianke.com/346b72a0b2dec88e8a45272f0960213120190104.png?imageView2/2/w/300/format/jpg" /></a>
         </div> 
         <div class="card-item">
          <div class="card-content">
           <a href="./timelineInfo.html?id=5c2eb68b257be9626160ce60" target="_blank">2019.1.4争取一上午画完鸭٩(˃̶͈̀௰˂̶͈́)و</a>
          </div> 
          <div class="timeline-voice" style="display: none;">
           <a href="./timelineInfo.html?id=5c2eb68b257be9626160ce60" target="_blank">[&nbsp;语音&nbsp;]</a>
          </div> 
          <div class="user-sign" style="display: none;">
           <a href="./timeline.html?tag=" target="_blank">#&nbsp;&nbsp;#</a>
          </div> 
          <div class="card-user">
           <div class="card-user-info">
            <a href="../user/user.html?uid=4408715" target="_blank" class=""><img src="http://hpimg.pianke.com/cf6b447632d3f12ab276579bdfa04ee720181025.png?imageView2/2/w/90/format/jpg" width="" />urnotcha</a>
           </div> 
           <div class="likes-cpt card-likes"></div>
          </div>
         </div>
        </div>
        <div class="card-timeline-cpt">
         <div class="card-top-img" style="display: none;">
          <a href="./timelineInfo.html?id=5c2eb59c257be9720860ce65" target="_blank"><img src="" /></a>
         </div> 
         <div class="card-item">
          <div class="card-content">
           <a href="./timelineInfo.html?id=5c2eb59c257be9720860ce65" target="_blank">熬夜了一晚上，得到的又是什么，辛苦这个词远不上满意。</a>
          </div> 
          <div class="timeline-voice" style="display: none;">
           <a href="./timelineInfo.html?id=5c2eb59c257be9720860ce65" target="_blank">[&nbsp;语音&nbsp;]</a>
          </div> 
          <div class="user-sign" style="display: none;">
           <a href="./timeline.html?tag=" target="_blank">#&nbsp;&nbsp;#</a>
          </div> 
          <div class="card-user">
           <div class="card-user-info">
            <a href="../user/user.html?uid=3694264" target="_blank" class=""><img src="http://hpimg.pianke.com/da9f7569b0cb2ef3362a9a0ec18cf55120180707.jpg?imageView2/2/w/90/format/jpg" width="" />南寻卿</a>
           </div> 
           <div class="likes-cpt card-likes"></div>
          </div>
         </div>
        </div>
        <div class="card-timeline-cpt">
         <div class="card-top-img">
          <a href="./timelineInfo.html?id=5c2eb594257be93f6160ce60" target="_blank"><img src="http://hpimg.pianke.com/a47aa9911df6bc079dae3f3adfbf30fe20190104.jpg?imageView2/2/w/300/format/jpg" /></a>
         </div> 
         <div class="card-item">
          <div class="card-content">
           <a href="./timelineInfo.html?id=5c2eb594257be93f6160ce60" target="_blank">昨天的夜幕</a>
          </div> 
          <div class="timeline-voice" style="display: none;">
           <a href="./timelineInfo.html?id=5c2eb594257be93f6160ce60" target="_blank">[&nbsp;语音&nbsp;]</a>
          </div> 
          <div class="user-sign" style="display: none;">
           <a href="./timeline.html?tag=" target="_blank">#&nbsp;&nbsp;#</a>
          </div> 
          <div class="card-user">
           <div class="card-user-info">
            <a href="../user/user.html?uid=4195003" target="_blank" class=""><img src="http://hpimg.pianke.com/e0dca3f515848a9d2392650150da4bbb20181018.jpg?imageView2/2/w/90/format/jpg" width="" />灏祁</a>
           </div> 
           <div class="likes-cpt card-likes"></div>
          </div>
         </div>
        </div>
        <div class="card-timeline-cpt">
         <div class="card-top-img" style="display: none;">
          <a href="./timelineInfo.html?id=5c2eb58a257be9f95360ce60" target="_blank"><img src="" /></a>
         </div> 
         <div class="card-item">
          <div class="card-content">
           <a href="./timelineInfo.html?id=5c2eb58a257be9f95360ce60" target="_blank">又想吐了。算了。还是退回到之前算了。</a>
          </div> 
          <div class="timeline-voice" style="display: none;">
           <a href="./timelineInfo.html?id=5c2eb58a257be9f95360ce60" target="_blank">[&nbsp;语音&nbsp;]</a>
          </div> 
          <div class="user-sign" style="display: none;">
           <a href="./timeline.html?tag=" target="_blank">#&nbsp;&nbsp;#</a>
          </div> 
          <div class="card-user">
           <div class="card-user-info">
            <a href="../user/user.html?uid=4563291" target="_blank" class=""><img src="http://hpimg.pianke.com/1bcdc39754c26168e986ca9212c5b31520180113.png" width="" />最好点点点</a>
           </div> 
           <div class="likes-cpt card-likes"></div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div> 
   <div class="back-top hidden"></div> 
  </div>
 




@endsection