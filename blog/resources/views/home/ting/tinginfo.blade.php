@extends('home/layout/index')
@section('content')

  <div class="container">
      <div class="index-content">
       <audio id="audiosrc" src="http://hpimg.pianke.com/25f2ac0489a6490efacbc748f94071b520181220.mp3">
        您的浏览器不支持 audio 标签。
       </audio> 
       <div class="ting-info-box">
        <div class="radio-info-content ting-info-content">
         <div class="ting-img">
          <img src="{{ $info->img }}" />
         </div> 
         <div class="radio-info ting-info">
          <div class="radio-title">
           {{ $info->title }}
          </div> 
          <div class="ting-others">
           {{ $info->listen }} k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:&nbsp;33&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:&nbsp;{{ $info->like }}
          </div> 
          <div class="authors">
           <div class="ting-author">
            主播:&nbsp;
            <a href="../user/user.html?uid=296663" target="_blank">{{ $info->tname }}</a>
           </div> 
           
          </div> 
          <div class="play-all" >
          
           <div class="btn-play play-status-btn" class="pbegin" style="display: none;">
            播放Ting
           </div> 
           <div class="btn-pause play-status-btn" class="jbegin" style="">
            暂停Ting
           </div>
           <div  style="border: 1px solid #000;width:25px;height: 25px;opacity:0;position: absolute;top:9px;left:9px; overflow: hidden;"><audio src="{{ $info->music }}"  autoplay="" controls=""></audio></div>
          </div> 
    <script type="text/javascript">
      $('.pbegin').click(function(){
          alert('aaa');
          //$(this).css('display','none');
      });
    </script>


          <div class="likes-cpt ting-like"></div> 
          <div class="ting-share">
           <div class="share-icon-cpt ting-share-icon"></div> 
           <div class="share-menu">
            <div class="drop-menu share-menu-item">
             <div class="share-cpt">
              <div class="share-sina"></div> 
              <div class="share-wechat">
               <div class="code">
                <img src="http://api5.pianke.me/version5.0/wxshare/qrcode.php?url=http%3A%2F%2Fpianke.me%2Fversion4.0%2Fweixin02%2Fwxshare.php%23!%2Fradio%2F5b66a442257be97613cf8964" width="200" />
               </div>
              </div> 
              <div class="share-qzone"></div> 
              <div class="share-dou"></div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </div> 
        <div class="ting-article-content">
         <div class="title-cpt">
          原文
         </div> 
         <div class="article-content">
          <span style="display: block;padding-bottom: 10px;">-</span> “世间多少舍不得，中间藏了来不及&nbsp;伤心和失意是会传染的，这种传染能力会超过开心和愉快的传染能力，人们向往美好没错，但时常是苦痛的记忆让一个人成长，深刻记得的往往不是哪个夏天喝了一口沁心的啤酒，是哪个夏天有个人突然就不见了。&nbsp;前不久我在微博里分享了最近的心酸瞬间，其中之一就关于我的朋友。她的父亲最近不在了，这就是我说的哪个夏天有个人突然不见的时刻。她的父亲是因为癌症，不是故事里的... 
          <span class="view-all"><a href="../read/articleInfo.html?id=5b66a2af257be9df34cf8962" target="_blank">VIEW ALL<img src="http://qnstatic.pianke.me/public/assets/img/viewall.png" /></a></span>
         </div>
        </div> 
        <div class="ting-comment-box">
         <div class="ting-comment">
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
          <div class="comment-title-cpt">
           <div>
            评论
            <span>(33&nbsp;条)</span>
           </div>
          </div> 
          <div class="comment-list-group">
           <div class="comment-cpt">
            <div class="comment-user-icon">
             <a href="../user/user.html?uid=166757" target="_blank"><img src="http://pkicon.image.alimmdn.com/icon/757/166757/b099c2cd975df5f1f3c7c2e3ae276b93_180" /></a>
            </div> 
            <div class="comment-info">
             <div class="comment-user-info">
              <a href="../user/user.html?uid=166757" target="_blank">所有无用之人都死于诗意</a>2018-12-19 
              <span class="comment-reply disClick">回复</span> 
              <span class="comment-del" style="display: none;">删除</span> 
              <span class="comment-number">0</span> 
              <span class="comment-del report">举报</span>
             </div> 
             <div class="comment-content">
              快乐往往让我们记不住。人的趋利避害的本能，总是让我们优先记住了让我们痛的东西。但人生苦痛太多，苦痛让我们成长，但幸福才值得我们珍惜。这首日语歌很好听。
             </div> 
             <div class="com-textarea hidden">
              <textarea name="" id="replyTextarea" maxlength="360" placeholder="请输入回复内容"></textarea> 
              <div class="btn-group">
               <div class="btn">
                发送
               </div> 
               <div class="btn-cancle">
                取消
               </div>
              </div>
             </div> 
            </div>
           </div>
           </div> 
           <div class="common-more-btn" style="">
            查看更多评论
           </div> 
           <div class="no-more-data" style="display: none;">
            -&nbsp;已加载全部&nbsp;-
           </div>
          </div> 
          <div class="no-comment" style="display: none;">
            暂时没有评论，快和小伙伴互动吧 
          </div>
         </div>
        </div>
       </div>
      </div>
 
  <div class="back-top hidden"></div> 

@endsection