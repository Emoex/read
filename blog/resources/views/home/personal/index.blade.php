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
          @if(session('user')['id'] != $user->id && $status == 'no')
          <span class="btn-focus" style="display:inline" id="follow">关注</span>
          <span class="btn-focus btn-focus-yes" style="display: none;" id="follow_yes">已关注</span>
          @elseif(session('user')['id'] != $user->id && $status == 'yes')
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
        </div>
      </div>
    </div>
    <div class="user-menu">
      <div class="type-title-cpt">
        <span class="active" id="homepage">我的主页</span>
        <span class="" id="information">消息中心</span></div>
    </div>
  </div>
  <div class="data-title data-title-home" style="">
    <span class="active">
      <a>文章</a>({{ $article_num }})</span>
    <span class="">
      <a>碎片</a>({{ $timeline_num }})</span>
    <span class="">
      <a>Ting</a>({{ $ting_num }})</span>
  </div>
  <div class="data-title  data-title-msg" style="display: none;">
    <span class="active">
      <a>评论</a>(13)</span>
    <span class="">
      <a>喜欢</a>(0)</span>
    <span class="">
      <a>粉丝</a>({{ count($fans) }})</span>
    <!-- <span class="">
      <a>片邮</a>(2)</span> -->
  </div>
  <div class="data-title data-title-like" style="display: none;">
    <span class="active">
      <a>粉丝</a>
    </span>
    <span class="">
      <a>关注</a>
    </span>
  </div>
  <div class="data-content">
    <!-- <div class="no-comment" style="">您还没有发布过作品</div> -->
    <div style="min-height: 200px; " class="img-group-cpt " id="articles">
    <!-- 文章 -->
    @foreach($article as $k=>$v)
            <div data-index="0" class="card-read-cpt" style="left: 0px; opacity: 1;position: absolute;" id="article">
            @if($v->image)
             <div style="" class="card-top-img">
                <a href="/home/article/{{ $v->id }}" target="_blank">
                  <img src="{{ $v->image }}" class="lazy loaded"></a>
              </div>
            @endif
              <div class="card-item">
                <div class="card-read-title">
                  <a href="/home/article/{{ $v->id }}" target="_blank">{{ $v->title }}</a></div>
                <div class="card-content" style="height:180px;overflow:hidden"><div style="height:170px;overflow:hidden">{{ preg_replace('/<\/?.+?\/?>/','',$v->content) }}</div>
                  <span class="view-all">
                    <a href="/home/article/{{ $v->id }}" target="_blank">VIEW ALL
                      <img src="http://qnstatic.pianke.me/public/assets/img/viewall.png"></a></span>
                </div>
                <div class="card-others">
                  <span class="card-type">
                    <a href="/home/article/{{ $v->id }}" target="_blank">阅读</a></span>
                  <span>{{ $v->look }}次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:{{ $v->comment }}&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->like }}</span></div>
              </div>
            </div>
    @endforeach
    </div>
    {{ csrf_field() }}
    <input type="hidden" name="uid" value="{{ $user->id }}">
   
    <!-- 碎片 -->
    <div style="min-height: 200px;" class="img-group-cpt hidden" id="timelines">
      @foreach($timeline as $k=>$v)
        <div data-index="0" class="card-read-cpt" style="left: 0px; opacity: 1;position:absolute" id="timeline">
            @if($v->image)
             <div style="" class="card-top-img">
                <a href="/home/timeline/{{ $v->id }}" target="_blank">
                  <img src="{{ $v->image }}" class="lazy loaded"></a>
              </div>
            @endif
            <div class="card-item">
              <div class="card-content">
                <a href="/home/timeline/{{ $v->id }}" target="_blank">{{ $v->content }}</a></div>
              <div style="padding-top: 10px" class="card-others">
                <span class="card-type">
                  <a href="/home/timeline/{{ $v->id }}" target="_blank">碎片</a></span>
                <span>382次阅读&nbsp;&nbsp;|&nbsp;&nbsp;评论:6&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:18</span></div>
            </div>
       </div>
    @endforeach
     </div>

     <!-- 电台 -->
      <div style="min-height: 200px;" class="img-group-cpt hidden" id="tings">
        @foreach($ting as $k=>$v)
          <div data-index="0" class="card-read-cpt" style="left: 0px; opacity: 1;position:absolute" id="ting">
          @if($v->img)
             <div style="height: 290px" class="card-top-img">
                <a href="/home/ting/{{ $v->id }}" target="_blank">
                  <img src="{{ $v->img }}">
                  <span></span>
                </a>
              </div>
          @endif
              <div class="card-item">
                <div class="card-ting-title">
                  <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a></div>
                <div class="user-sign">
                  <a href="/home/personal/{{ $v->uid }}" target="_blank">主播&nbsp;/&nbsp;{{ $v->tname }}</a></div>
                <div class="card-others">
                  <span class="card-type">
                    <a href="/home/ting/{{ $v->id }}" target="_blank">Ting</a></span>
                  <span>5.6 k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:10&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:101</span></div>
              </div>
         </div>
      @endforeach
       </div>


       <script>
// 我的主页
            var index = 0;
            var p = 2;
            var num = 5;
            var isLoad = false;
            var preg = /<\/?.+?\/?>/g;
            minigrid('#articles','#article');
            // 切换文章、碎片、Ting
            $('.data-title-home span').click(function(){
                index =  $(this).index();
                $('.img-group-cpt').addClass('hidden');
                $('.img-group-cpt').eq(index).removeClass('hidden');
                $('.data-title-home span').removeClass('active');
                if(index == 0){
                  minigrid('#articles','#article');
                }else if(index == 1){
                  p = 2;
                  getData();
                  minigrid('#timelines','#timeline');
                }else if(index == 2){
                  p = 2;
                  num = 5;
                  getData();
                  minigrid('#tings','#ting');
                }
                $(this).addClass('active');
            })
           
           // 点击粉丝关注
           $('.user-others a').click(function(){
                $('.img-group-cpt').addClass('hidden');
                $('.data-title-home').addClass('hidden');
                $('.data-title-like').css('display','block');
                $('.data-title-msg').css('display','none');
                $('.user-like-list').css('display','none');
                $('.user-like-list').eq($(this).index()).css('display','block');
                $('.data-title-like span').removeClass('active');
                $('.data-title-like span').eq($(this).index()).addClass('active');
           })
         
           $('.data-title-like span').click(function(){
                $('.data-title-like span').removeClass('active');
                $(this).addClass('active');
                $('.user-like-list').css('display','none');
                $('.user-like-list').eq($(this).index()).css('display','block');
           })

           $('#homepage').eq(0).click(function(){
                $('.img-group-cpt').eq(0).removeClass('hidden');
                $('.data-title-home').removeClass('hidden');
                minigrid('#articles','#article');
                $('.data-title-like').css('display','none');
                $('.user-like-list').css('display','none');
                $('.data-title-msg').css('display','none');
           })

            // 我的主页获取数据
            getData();
            function getData()
            {
              $.post('/home/personal/pinterest',{'index':index,'id':$('input[name=uid]').val(),'p':p,'num':num,'_token':$('input[name=_token]').val()},function(data){
                  if(data.msg != 'error'){
                    $.each(data,function(key,val){
                      if(index == 0){
                          // 克隆div
                          var temp = $('.card-read-cpt').eq(0).clone(true);
                          // 修div中内容
                          temp.find('.card-top-img a').eq(0).attr('href','/home/article/'+val.id);
                          if(val.image){
                            temp.find('.card-top-img a img').eq(0).attr('src',val.image);
                          }else{
                            temp.find('.card-top-img a img').addClass('hidden');
                          }
                          temp.find('.card-read-title a').eq(0).attr('href','/home/article/'+val.id);
                          temp.find('.card-read-title a').eq(0).text(val.title);
                          temp.find('.card-content div').eq(0).html(val.content.replace(preg,''));
                          temp.find('.view-all a').eq(0).attr('href','/home/article/'+val.id);
                          temp.find('.card-type a').eq(0).attr('href','/home/article/'+val.id);
                          // 追加到内容
                          $('#articles').append(temp);
                          minigrid('#articles','#article');
                      }else if(index == 1){
                          var temp = $('#timelines .card-read-cpt').eq(0).clone(true);
                          if(val.image){
                            temp.find('.card-top-img a').attr('href','/home/timeline/'+val.id);
                            temp.find('.card-top-img a img').attr('src',val.image);
                          }else{
                            temp.find('.card-top-img a img').addClass('hidden');
                          }
                          temp.find('.card-content a').attr('href','/home/timeline/'+val.id);
                          temp.find('.card-content a').text(val.content);
                          temp.find('.card-type a').attr('href','/home/timeline/'+val.id);
                          $('#timelines').append(temp); 
                          minigrid('#timelines','#timeline');
                      }else if(index == 2){
                          var temp = $('#tings .card-read-cpt').eq(0).clone(true);
                          if(val.img){
                            temp.find('.card-top-img a').attr('href','/home/ting/'+val.id);
                            temp.find('.card-top-img a img').attr('src',val.img);
                          }else{
                            temp.find('.card-top-img a img').addClass('hidden');
                          }
                          temp.find('.card-ting-title a').attr('href','/home/ting/'+val.id);
                          temp.find('.card-ting-title a').text(val.title);
                          temp.find('.user-sign a').attr('href','/home/personal/'+val.id);
                          temp.find('.user-sign a').html("主播&nbsp;/&nbsp;"+val.tname);
                          temp.find('.card-type a').attr('href','/home/ting/'+val.id);
                          $('#tings').append(temp); 
                          minigrid('#tings','#ting');
                      }
                      
                    });
                    p++;
                    isLoad = false;
                  }else{
                    $('.no-more-data').css('display','block');
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
              if(bottomHeight <= 100){
                isLoad = true;
                getData();
              }
            });
//点击切换我的主页和消息中心
            $('.type-title-cpt span').click(function(){
                $('.type-title-cpt span').removeClass('active');
                $(this).addClass('active');
            })
            $('#information').eq(0).click(function(){
                $('.img-group-cpt').addClass('hidden');
                $('.data-title-home').addClass('hidden');
                $('.data-title-like').css('display','none');
                $('.user-like-list').css('display','none');
                $('.data-title-msg').css('display','block'); 
            }) 

            


    </script>
    
    <!-- 关注 粉丝 -->
    <div class="user-like-list" style="display: none;margin-top:0px;" id="fans">
         @foreach($fans as $k=>$v)
          <div class="user-like-cpt">
                  <div class="s-user-icon">
                    <a href="/home/personal/{{ $v->uid }}" target="_blank">
                      <img src="{{ $v->User->face }}"></a>
                  </div>
                  <div class="s-user-info">
                    <div class="s-user-name">
                      <a href="/home/personal/{{ $v->uid }}" target="_blank">{{ $v->User->nickname or $v->User->uname }}</a></div>
                    <div class="s-user-des">{{ $v->User->intro }}</div></div>
                  @if($v->status == 3 && $user->id == session('user')['id'])
                  <div class="btn-focus btn-focus-all fans__yes"  onclick="fans({{ $v->uid }},1,this)">互相关注</div>
                  <div class="btn-focus fans__no" style="display:none;" onclick="fans({{ $v->uid }},2,this)">关注</div>
                  @elseif($v->status == 1 && $user->id == session('user')['id'])
                  <div class="btn-focus btn-focus-all fans__yes" style="display:none;" onclick="fans({{ $v->uid }},1,this)">互相关注</div>
                  <div class="btn-focus fans__no" onclick="fans({{ $v->uid }},2,this)">关注</div>
                  @endif
                 
          </div>
          @endforeach
    </div>
    <div class="user-like-list" style="display: none;margin-top:0px;" id="follow">
         @foreach($follow as $k=>$v)
          <div class="user-like-cpt">
                  <div class="s-user-icon">
                    <a href="/home/personal/{{ $v->follow_user }}" target="_blank">
                      <img src="{{ $v->Follow_user->face }}"></a>
                  </div>
                  <div class="s-user-info">
                    <div class="s-user-name">
                      <a href="/home/personal/{{ $v->follow_user }}" target="_blank">{{ $v->Follow_user->nickname or $v->Follow_user->uname }}</a></div>
                    <div class="s-user-des">{{ $v->Follow_user->intro }}</div></div>
                  @if($v->status == 3 && $user->id == session('user')['id'])
                  <div class="btn-focus btn-focus-all follow__yes" onclick="follow({{ $v->follow_user }},3,this)">互相关注</div>
                  <div class="btn-focus follow__no" onclick="follow({{ $v->follow_user }},1,this)" style="display:none;">关注</div>
                  @elseif($v->status == 2 && $user->id == session('user')['id'])
                  <div class="btn-focus btn-focus-yes follow__yes" onclick="follow({{ $v->follow_user }},3,this)">已关注</div>
                  <div class="btn-focus follow__no" onclick="follow({{ $v->follow_user }},1,this)" style="display:none;">关注</div>
                  @endif
          </div>
          @endforeach
    </div>

<!-- 粉丝 -->
      <div class="msg-focus-cpt">
      <div class="m-user-icon">
        <a href="./user.html?uid=4764921" target="_blank">
          <img src="http://thirdwx.qlogo.cn/mmopen/vi_32/1ticCtULhM44n9f8ghgNCWcac62HEJ8UfAt3CdiaASibBxPrIJrlLtibURmlY4GIYRnn4iasouuhYlXhVAVxic3iadAWw/132"></a>
      </div>
      <div class="m-info">
        <div class="m-user-name">
          <a href="./user.html?uid=4764921" target="_blank">A52赫兹</a></div>
        <div>
          <span class="msg-title">关注了你。</span></div>
        <div class="btn-focus" style="display: none;">关注</div>
        <div class="btn-focus btn-focus-all">互相关注</div></div>
    </div>
<!-- 内容结束 -->
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

            fans = function(uid,type,obj){
                   var index = $(obj).parents('.user-like-cpt').index();
                if(type == 1){
                     $.post('/home/follow/'+uid,{'_token':$('input[name=_token]').val(),'_method':'DELETE'},function(msg){
                       if(msg == 'success'){
                         $('.user-like-cpt .fans__no').eq(index).css('display','block');
                         $('.user-like-cpt .fans__yes').eq(index).css('display','none');
                       }
                    },'html')
                }else{
                    $.post('/home/follow',{'_token':$('input[name=_token]').val(),'follow_user':uid},function(msg){
                       if(msg == 'success'){
                         $('.user-like-cpt .fans__yes').eq(index).css('display','block');
                         $('.user-like-cpt .fans__no').eq(index).css('display','none');
                       }
                    },'html')
                }    
            }

            follow = function(uid,type,obj){
              var index = $(obj).parents('.user-like-cpt').index();
               if(type == 3){
                  $.post('/home/follow/'+uid,{'_token':$('input[name=_token]').val(),'_method':'DELETE'},function(msg){
                 if(msg == 'success'){
                       $('.follow__yes').eq(index).css('display','none');
                       $('.follow__no').eq(index).css('display','block');
                     }
                  },'html')
               }else{
                $.post('/home/follow',{'_token':$('input[name=_token]').val(),'follow_user':uid},function(msg){
                 if(msg == 'success'){
                       $('.follow__yes').eq(index).css('display','block');
                       $('.follow__no').eq(index).css('display','none');
                     }
                  },'html')
               }
            }
        })

</script>
@endsection
