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
           <font id="listen">{{ $info->listen }}</font>次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:&nbsp;{{ $num }}&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:&nbsp;{{ $info->likes }}
          </div> 
          <div class="authors">
           <div class="ting-author">
            主播:&nbsp;
            <a href="/home/personal/{{ $info->uid }}" target="_blank">{{ $info->User->nickname }}</a>
           </div> 
           
          </div> 
          <label for="#audio">
          <div class="play-all" onclick="music()">
           <div class="btn-play play-status-btn" style="display:none;">
            播放Ting
           </div> 
           <div class="btn-pause play-status-btn" style="display:block;">
            暂停Ting
           </div>
           <div  style="display: none"><audio src="{{ $info->music }}" id="audio" autoplay controls=""></audio></div>
          </div>
          </label> 
          <script type="text/javascript">
             $(function(){
                   $('.btn-play').click(function(){
                      $('.btn-play').css('display','none');
                      $('.btn-pause').css('display','block');
                   })
                   $('.btn-pause').click(function(){
                      $('.btn-pause').css('display','none');
                      $('.btn-play').css('display','block');
                   })
                   $('#audio').click(function(){
                     alert(1);
                   })

                  var player = $("#audio")[0];
                  if(player.paused){
                     $('.btn-pause').css('display','none');
                      $('.btn-play').css('display','block');
                      player.pause();
                    }else{
                      $('.btn-play').css('display','none');
                      $('.btn-pause').css('display','block');
                       player.play();
                    }
                  music = function(){
                    
                    if (player.paused){ /*如果已经暂停*/
                        player.play(); /*播放*/
                    }else {
                        player.pause();/*暂停*/
                    }
                  }
              })
          </script>
          @if(isset($info->is_like))
          <div class="likes-cpt ting-like likes" style="margin-left:0px;"></div> 
          @else
          <div class="likes-cpt ting-like" style="margin-left:0px;width:50px;"></div> 
          @endif
          @if(session('user')['id'] == $info->uid)
         <a href="javascript:;" style="letter-spacing:3px;font-size:12px;" onclick="del({{ $info->id }})">删除</a>
         @endif
         </div>
        </div> 
        <div class="ting-article-content">
         <div class="title-cpt">
          原文
         </div> 
         <div class="article-content" style="height:213px;">
          <span style="display: block;padding-bottom: 10px;">-</span> <span style="height:110px;overflow: hidden;display: block;">{!! $article->content !!}</span>
          <span class="view-all" style="position: relative;padding-top:2px;padding-left:10px;"><a href="/home/article/{{$article->id}}" target="_blank">VIEW ALL<img src="http://qnstatic.pianke.me/public/assets/img/viewall.png" /></a></span>
         </div>
        </div> 
        <div class="ting-comment-box">
         <div class="ting-comment">
          <div class="is-login-cpt">
          @if(!session('user'))
           <div class="if-no-login">
             快来
            <a class="btn">登录</a>发表你的精彩评论啦 
           </div> 
           @else
           <div class="is-login" style="">
            <textarea name="comment" id="" maxlength="360" placeholder="发表你的精彩评论啦"></textarea> 
            <div class="btn" id="comment">
             发表评论
            </div>
           </div>
           @endif
          </div> 
          <div class="comment-title-cpt">
           <div>
            评论
            <span>({{ $num }}&nbsp;条)</span>
           </div>
          </div> 
<!-- 评论开始 -->
<script type="text/javascript">
       $(function(){
            del = function(id){
            confirm('删除的内容不可找回, 确认删除?');
            $('#confirm div:eq(1)').unbind("click").click(function(){
              $('.Confirm').addClass('hidden');
              $.post('/home/ting/'+id,{'_token':$('input[name=_token]').val(),'_method':'DELETE'},function(msg){
                if( msg == 'success'){
                  window.location.href='/home/ting';
                }else{
                  error('删除失败！');
                }
              },'html'); 
            })
          }

            dododo = function (parent_id,obj)
            {
              var index = $(obj).parents('.comment-cpt').index();
              if($('.com-textarea').eq(index).hasClass('hidden')){
                  $('.com-textarea').addClass('hidden');
                  $('.com-textarea').eq(index).removeClass('hidden');

                  $('.btn-cancle').unbind("click").click(function(){
                    $('.com-textarea').eq(index).addClass('hidden');
                  })
                  
                  $('.send').eq(index).unbind("click").click(function(){
                    if($('.reply').eq(index).val()){
                      var content = $('.reply').eq(index).val();
                      $.post('/home/ting/comment',{'_token':$('input[name=_token]').val(),'tid':{{ $info->id }},'content':content,'parent_id':parent_id},function(data){
                     if(data['msg'] == 'success'){
                       div = '<div class="comment-content-others"><input type="hidden" name="parent_id" value="'+data['id']+'"><a href="../user/user.html?uid=4934695" target="_blank">　'+data['uname']+':</a>'+data['content']+'<span class="comment-del" onclick="destroy('+data['uid']+','+data['id']+',this,2)">删除</span></div>';
                       $('.com-textarea').eq(index).before(div);
                       $('.com-textarea').eq(index).addClass('hidden'); 
                       $('.reply').eq(index).val('');
                     }else{
                        error('回复失败');
                     }
                  },'json');

                    }else{
                      error('内容不能为空');
                    }

                  })

               }else{
                  $('.com-textarea').eq(index).addClass('hidden');
               } 
            }
            $('#comment').unbind("click").click(function(e){
               if($(this).prev().val()){
                  $.post('/home/ting/comment',{'_token':$('input[name=_token]').val(),'tid':{{ $info->id }},'content':$('[name=comment]').val(),'parent_id':0},function(data){
                     if(data['msg'] == 'success'){
                           $('.comment-cpt:last').children().first().children().first().attr('href','/home/user/');
                           $('.comment-cpt:last').children().first().children().first().children().first().attr('src',data['face']);
                           $('.comment-user-info:last').children().first().attr('href','/home/user');
                           $('.comment-user-info:last').children().first().text(data['nickname']);
                           $('.comment-user-info:last').children().first().next().text('　'+data['time']);
                           $('.comment-content:last').text(data['content']);
                           $('.comment-number:last').text(data['like']);
                           $('.comment-cpt:last').css('display','');
                           $('.del:last').attr('onclick','destroy('+data['uid']+','+data['id']+',this,1)');
                           $('.comment-list-group:first').prepend('<div class="comment-cpt" style="">'+$('.comment-cpt:last').html()+'</div>');
                           $('.comment-cpt:last').css('display','none');
                     }else{
                        error('评论失败');
                     }
                  },'json');
               }else{
                  error('内容不能为空');
               }
            })
            setTimeout(function(){
             $.post('/home/ting/listen',{'_token':$('input[name=_token]').val(),'tid':{{ $info->id }}},function(data){
                      $('#listen').text(data['listen']);
             },'json');
           },5000);
           
           $('.likes-cpt').unbind("click").click(function(){
            $.post('/home/ting/like',{'_token':$('input[name=_token]').val(),'tid':{{ $info->id }}},function(data){
                      if(data['msg'] == 'like'){
                        $('.likes-cpt').addClass('likes');
                        $('.likes-cpt').text(data['like']);
                      }else{
                        $('.likes-cpt').removeClass('likes');
                        $('.likes-cpt').text(data['like']);
                      }
                      
             },'json');
           })
   
           destroy = function(uid,id,obj,bj){
              confirm('确认删除？');
              $('#confirm div').eq(1).unbind("click").click(function(){
                    $.post('/home/ting/comment/'+id,{'_token':$('input[name=_token]').val(),'tuid':uid,'_method':'DELETE'},function(data){
                        $('.Confirm').addClass('hidden');     
                        if(data['msg'] == 'success'){
                          success('删除成功');
                          if(bj == 2){
                            $(obj).parent().remove();
                          }else{
                            $(obj).parent().parent().parent().remove();
                          }
                        }else{
                          error('删除失败');
                        }
                    },'json')
              })
           }

          report = function(id,table){
            confirm('确认要举报吗？');
            $('#confirm div').eq(1).unbind("click").click(function(){
              $.post('/home/report',{'_token':$('input[name=_token]').val(),'idid':id,'table':table},function(msg){
                 $('.Confirm').addClass('hidden');
                 if(msg == 'success'){
                    success('举报成功');
                 }
              },'html');
              return false;
            })
          }
            
             //成功消息
             function success(text)
              {
                $('#success').text(text).show();
                setTimeout(function(){
                  $('#success').text('').hide();
                },2000);
              }

              //错误消息
             function error(text)
              {
                $('#error').text(text).show();
                setTimeout(function(){
                  $('#error').text('').hide();
                },2000);
              }
                //确认框
            function confirm(text)
            {
              $('.Confirm').removeClass('hidden');
              $('.Confirm').find('div').eq(0).html(text);
              $('#confirm div').eq(0).click(function(){
                $('.Confirm').addClass('hidden');
              });
            } 
       })
</script> 
<!-- 评论结束 -->
          <div class="comment-list-group">
          @foreach($comment as $k=>$v)
                 <div class="comment-cpt">
                  <div class="comment-user-icon">
                   <a href="/home/personal/{{ $v->uid }}" target="_blank"><img src="{{ $v->User->face }}" /></a>
                  </div> 
                  <div class="comment-info">
                   <div class="comment-user-info">
                    <a href="/home/personal/{{ $v->uid }}" target="_blank">{{ $v->User->nickname }}</a><span>　{{ $v->created_at }}</span>
                    <span class="comment-reply" onclick="dododo({{ $v->id }},this);">回复</span>
                    @if($v->uid == session('user')['id'] || session('user')['id'] == $info->uid) 
                    <span class="comment-del" onclick="destroy({{$v->uid}},{{ $v->id }},this,1)">删除</span>
                    @else
                    <span class="comment-del report" onclick="report({{ $v->id }},'ting_comment')">举报</span>
                    @endif
                   </div> 
                   <div class="comment-content">
                    {{ $v->content }}
                   </div> 
                   @if($v->children)
                         @foreach($v->children as $kk=>$vv)
                           <div class="comment-content-others">
                              <a href="../user/user.html?uid=4934695" target="_blank">　{{ $vv->User->nickname }}:</a>{{ $vv->content }}
                              @if($vv->uid == session('user')['id'] || session('user')['id'] == $info->uid)
                          <span class="comment-del delete" onclick="destroy({{$vv->uid}},{{ $vv->id }},this,2)">删除</span>
                              @else
                          <span class="comment-del report" onclick="report({{ $vv->id }},'ting_comment')">举报</span>
                              @endif
                           </div>
                          @endforeach
                     @endif
                   <div class="com-textarea hidden">
                    <textarea name="" id="replyTextarea" maxlength="360" class='reply' placeholder="请输入回复内容"></textarea> 
                    <div class="btn-group">
                     <div class="btn send">
                      发送
                     </div> 
                     <div class="btn-cancle">
                      取消
                     </div>
                    </div>
                   </div> 
                  </div>
                 </div>
         @endforeach
          
         <div class="comment-cpt" style="display:none">
        <div class="comment-user-icon">
         <a href="../user/user.html?uid=3404651" target="_blank"><img src="http://q.qlogo.cn/qqapp/100339551/8F7A508551FF3247337B3665F290B595/100" /></a>
        </div> 
        <div class="comment-info">
         <div class="comment-user-info">
          <a href="../user/user.html?uid=3404651" target="_blank">吱吱1453813691</a><span>2018-12-4 13:35</span>  
          <span class="comment-reply">回复</span> 
          <span class="comment-del del" >删除</span> 
         </div> 
         <div class="comment-content">
          谢谢
         </div> 
         <div class="com-textarea hidden">
          <textarea name="" class="reply" id="replyTextarea" maxlength="360" placeholder="请输入回复内容"></textarea> 
          <div class="btn-group">
           <div class="btn send">
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
           <div class="common-more-btn" style="display: none;">
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
{{ csrf_field() }}
  <div class="back-top hidden"></div> 
}

@endsection