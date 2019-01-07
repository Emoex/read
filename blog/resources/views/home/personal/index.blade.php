@extends('home/layout/index')
@section('content')
<div class="container">
  <div class="user-base-content">
    <div class="user-info-box">
      <div class="user-icon-group">
        <div class="user-icon">
          <img src="{{ $user->face }}">
          <div class="others-user-authentication" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-author1.png" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-craftsman1.png" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-designer1.png" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-illustrator1.png" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-musician1.png" style="display: none;">
            <img src="http://qnstatic.pianke.me/public/assets/img/user-anchor1.png" style="display: none;"></div>
        </div>
        <div class="medal-icon hidden">
          <a href="">
            <img src=""></a>
          <a href="">
            <img src=""></a>
          <a href="">
            <img src=""></a>
          <a href="">
            <img src=""></a>
          <a href="">
            <img src=""></a>
        </div>
      </div>
      <div class="user-info">
        <div class="user-name">
          <span>{{ $user->nickname or $user->uname }}</span>
          @if(session('user')['id'] != $user->id && $follow == 'no')
          <span class="btn-focus" style="display:inline" id="follow">关注</span>
          <span class="btn-focus btn-focus-yes" style="display: none;" id="follow_yes">已关注</span>
          @elseif(session('user')['id'] != $user->id && $follow == 'yes')
          <span class="btn-focus" style="display:none" id="follow">关注</span>
          <span class="btn-focus btn-focus-yes" style="display: inline;" id="follow_yes">已关注</span>
          @endif
          <span class="btn-focus btn-focus-yes" style="display: none;">已关注</span>
          <img src="http://qnstatic.pianke.me/public/assets/img/user_author.png" width="52px" style="display: none;">
          <img src="http://qnstatic.pianke.me/public/assets/img/user_craftsman.png" width="52px" style="display: none;">
          <img src="http://qnstatic.pianke.me/public/assets/img/user_designer.png" width="52px" style="display: none;">
          <img src="http://qnstatic.pianke.me/public/assets/img/user_illustrator.png" width="52px" style="display: none;">
          <img src="http://qnstatic.pianke.me/public/assets/img/user_musician.png" width="52px" style="display: none;">
          <img src="http://qnstatic.pianke.me/public/assets/img/user_anchor.png" width="52px" style="display: none;">
          <span class="pianke-mail" style="display: none;"></span>
        </div>
        <div class="user-des">{{ $user->intro }}</div>
        <div class="user-others">
          <a class="">{{ $fans_num }}
            <br>
            <span>粉丝</span></a>
          <a class="">{{ $follow_num }}
            <br>
            <span>关注</span></a>
          <a class="">8
            <br>
            <span>访客</span></a>
        </div>
      </div>
    </div>
    <div class="user-menu">
      <div class="type-title-cpt">
        <span class="active">我的主页</span>
        <span class="">消息中心</span></div>
    </div>
  </div>
  <div class="data-title data-title-home" style="">
    <span class="active">
      <a>全部</a>(0)</span>
    <span class="">
      <a>文章</a>(0)</span>
    <span class="">
      <a>碎片</a>(0)</span>
    <span class="">
      <a>Ting</a>(0)</span>
  </div>
  <div class="data-title  data-title-msg" style="display: none;">
    <span class="active">
      <a>评论</a>(13)</span>
    <span class="">
      <a>喜欢</a>(0)</span>
    <span class="">
      <a>粉丝</a>(1)</span>
    <span class="">
      <a>片邮</a>(2)</span>
  </div>
  <div class="data-title data-title-like" style="display: none;">
    <span class="">
      <a>粉丝</a>
    </span>
    <span class="">
      <a>关注</a>
    </span>
    <span class="">
      <a>访客</a>
    </span>
  </div>
  <div class="data-content">
    <div class="no-comment" style="">您还没有发布过作品</div>
    <div style="min-height: 200px; height: 200px;" class="img-group-cpt"></div>
    <div class="msg-list" style="display: none;">
      <div class="msg-mail-cpt" style="display: none;">
        <div class="m-user-icon">
          <a href="./user.html?uid=4265344" target="_blank">
            <img src="https://qnimg.pianke.me/17e2291f5ec929797a30e4d0e75850c420181223.png?v=1545535081"></a>
        </div>
        <div class="m-info">
          <div class="m-user-name">
            <a href="./user.html?uid=4265344" target="_blank">来人间的猫儿</a>
            <span class="msg-date">[2018-12-31]</span></div>
          <div>
            <span class="msg-title">元旦快乐</span></div>
          <div class="msg-others">
            <span class="msg-reply">
              <a href="../piankeMail/piankeMail.html?touid=4265344&amp;toUname=%25E6%259D%25A5%25E4%25BA%25BA%25E9%2597%25B4%25E7%259A%2584%25E7%258C%25AB%25E5%2584%25BF&amp;touicon=https://qnimg.pianke.me/17e2291f5ec929797a30e4d0e75850c420181223.png?v=1545535081" target="_blank">回复</a></span>
          </div>
        </div>
      </div>
      <div class="msg-mail-cpt" style="display: none;">
        <div class="m-user-icon">
          <a href="./user.html?uid=4764921" target="_blank">
            <img src="http://thirdwx.qlogo.cn/mmopen/vi_32/1ticCtULhM44n9f8ghgNCWcac62HEJ8UfAt3CdiaASibBxPrIJrlLtibURmlY4GIYRnn4iasouuhYlXhVAVxic3iadAWw/132"></a>
        </div>
        <div class="m-info">
          <div class="m-user-name">
            <a href="./user.html?uid=4764921" target="_blank">4764921</a>
            <span class="msg-date">[2018-12-28]</span></div>
          <div>
            <span class="msg-title">我不是</span></div>
          <div class="msg-others">
            <span class="msg-reply">
              <a href="../piankeMail/piankeMail.html?touid=4764921&amp;toUname=4764921&amp;touicon=http://thirdwx.qlogo.cn/mmopen/vi_32/1ticCtULhM44n9f8ghgNCWcac62HEJ8UfAt3CdiaASibBxPrIJrlLtibURmlY4GIYRnn4iasouuhYlXhVAVxic3iadAWw/132" target="_blank">回复</a></span>
          </div>
        </div>
      </div>
      <div class="no-more-data" style="display: none;">-&nbsp;已加载全部&nbsp;-</div>
      <div class="loading" style="display: none;"></div>
    </div>
    <div class="user-like-list" style="display: none;"></div>
    <div class="no-more-data" style="display: none;">-&nbsp;已加载全部&nbsp;-</div>
    <div class="loading" style="display: none;"></div>
  </div>
</div>
{{ csrf_field() }}
<input type="hidden" value="{{ $user->id }}" name="uid">
<script>
        $(function(){
            $('#follow').click(function(){
              $.post('/home/follow',{'_token':$('input[name=_token]').val(),'follow_user':$('input[name=uid]').val()},function(msg){
                 if(msg == 'success'){
                   $('#follow').css('display','none');
                   $('#follow_yes').css('display','inline');
                 }
              },'html')
            })

            $('#follow_yes').click(function(){
              $.post('/home/follow/'+$('input[name=uid]').val(),{'_token':$('input[name=_token]').val(),'_method':'DELETE'},function(msg){
                 if(msg == 'success'){
                   $('#follow').css('display','inline');
                   $('#follow_yes').css('display','none');
                 }
              },'html')
            })

        })

</script>
@endsection