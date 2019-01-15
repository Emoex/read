@extends('home/layout/index')
@section('head')
    <link rel="stylesheet" type="text/css" href="/home/css/read.css">
@endsection
@section('content')
  <div class="index-content" style="padding-top:100px;">
   <div class="article-info-box">
    <div class="article-header-img" style="display: none; background-image: url(&quot;&quot;);"></div> 
    <div class="article-info-content">
     <div class="article-info">
      <div class="article-header-info">
       <div class="article-title">
        {{ $article->title }}
        <input type="hidden" name="uid" value="{{ $article->uid }}"> 
        <a href="http://pianke.me/editor/#!/article/5a4ba0b74cfcf3be5384d9c8" target="_blank" style="display: none;"><span></span></a> 
        <span class="del-article" style="display: none;"></span>
       </div> 
       <div class="article-others">
        <a href="/home/personal/{{ $article->User->id }}" target="_blank"><img src="{{ $article->User->face }}" width="40px" /> {{ $article->User->nickname }}</a> 
        <span>{{ $article->created_at }}&nbsp;&nbsp;|&nbsp;&nbsp;阅读时间: {{ (int)(strlen(preg_replace('/<\/?.+?\/?>/','',$article->content))/500) }}min &nbsp;&nbsp;|&nbsp;&nbsp;阅读次数:&nbsp;<foot id="look">{{ $article->look }}</foot></span>
       </div>
      </div> 
      <div class="article-content"> 
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
       <meta content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0" name="viewport" /> 
       <meta content="yes" name="apple-mobile-web-app-capable" /> 
       <title>片刻</title> 
       <style type="text/css">
        audio { width: 100%;}
        video { width: 100%;}
      </style> 
       <article class="typo container"> 
        <h1>{{ $article->title }}</h1> 
        <p class="author"><span>作者: {{ $article->User->nickname }}</span>&nbsp;&nbsp; <span>{{ (int)(strlen(preg_replace('/<\/?.+?\/?>/','',$article->content))/500) }} min read</span>&nbsp;&nbsp; </p> 
		{!! $article->content !!}
       </article> 
      </div> 
      @if(session('user'))
          @if(session('user')['id'] == $article->uid)
          <div class="article-report"> 
            <label><span class="report"><input type="submit" style="outline:0;background:none;border:none;cursor:pointer;color:#333;" value="删除" onclick="article({{ $article->id }})" id="article_delete" ></span></label>
          </div>
          @else
          <div class="article-report"> 
           <span class="report" onclick="report({{ $article->id }},'article')">举报</span>
          </div>
          @endif
      @endif
     </div> 
     <div class="article-handle">
     @if(isset($article->is_like))
        <div class="likes-cpt likes">
        {{ $article->like }} 
      </div> 
     @else
      <div class="likes-cpt">
        {{ $article->like }} 
      </div>
     @endif 
     </div> 
     <div class="is-login-cpt">
      @if(!session('user'))
      <div class="if-no-login">
        快来
       <a class="btn" href="javascript:;">登录</a>发表你的精彩评论啦 
      </div> 
      @else
      <div class="is-login" style="">

       <input type="hidden" value="{{ $article->id }}" name="aid">
       <input type="hidden" value="{{ session('user')['uname'] }}" name="name">
       {{ csrf_field() }}
       <textarea id="" maxlength="30" name="comment" placeholder="发表你的精彩评论啦"></textarea> 
       <div class="btn" id="comment">
        发表评论
       </div>
      </div>

     @endif
<script type="text/javascript">
       $(function(){
          article = function(id){
            confirm('删除的内容不可找回, 确认删除?');
            $('#confirm div:eq(1)').unbind("click").click(function(){
              $('.Confirm').addClass('hidden');
              $.post('/home/article/'+id,{'_token':$('input[name=_token]').val(),'_method':'DELETE'},function(msg){
                if( msg == 'success'){
                  window.location.href='/home/article';
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

                  $('.btn-cancle').click(function(){
                    $('.com-textarea').eq(index).addClass('hidden');
                  })
                  
                  $('.send').eq(index).unbind("click").click(function(){
                    if($('.reply').eq(index).val()){
                      var content = $('.reply').eq(index).val();
                      $.post('/home/article/comment',{'_token':$('input[name=_token]').val(),'aid':$('input[name=aid]').val(),'content':content,'parent_id':parent_id},function(data){
                     if(data['msg'] == 'success'){
                       div = '<div class="comment-content-others"><input type="hidden" name="parent_id" value="'+data['id']+'"><a href="/home/personal/'+data['uid']+'" target="_blank">　'+data['uname']+':</a>'+data['content']+'<span class="comment-del report" style="display: none;">举报</span><span class="comment-del" style="display:none">删除</span></div>';
                       $('.com-textarea').eq(index).before(div);
                       $('.com-textarea').eq(index).addClass('hidden'); 
                       $('.reply').eq(index).val('');
                     }else{
                        alert('回复失败');
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

            $('#comment').click(function(e){
               if($(this).prev().val()){
                  $.post('/home/article/comment',{'_token':$('input[name=_token]').val(),'aid':$('input[name=aid]').val(),'content':$('[name=comment]').val(),'parent_id':0},function(data){
                     $('[name=comment]').val('');
                     if(data['msg'] == 'success'){
                           $('.comment-cpt:last').children().first().children().first().attr('href','/home/personal/'+data['uid']);
                           $('.comment-cpt:last').children().first().children().first().children().first().attr('src',data['face']);
                           $('.comment-user-info:last').children().first().attr('href','/home/personal/'+data['uid']);
                           $('.comment-user-info:last').children().first().text(data['uname']);
                           $('.comment-user-info:last').children().first().next().text('　'+data['time']);
                           $('.comment-content:last').text(data['content']);
                           $('.comment-number:last').text(data['like']);
                           $('.comment-reply:last').attr('onclick','dododo('+data['id']+',this)');
                           $('.comment-cpt:last').css('display','');
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
             $.post('/home/article/look',{'_token':$('input[name=_token]').val(),'aid':$('input[name=aid]').val()},function(data){
                      $('#look').text(data['look']);
             },'json');
           },5000);
           
           $('.likes-cpt').click(function(){
            if(checkLogin()){
            $.post('/home/article/like',{'_token':$('input[name=_token]').val(),'aid':$('input[name=aid]').val()},function(data){
                      if(data['msg'] == 'like'){
                        $('.likes-cpt').addClass('likes');
                        $('.likes-cpt').text(data['like']);
                      }else{
                        $('.likes-cpt').removeClass('likes');
                        $('.likes-cpt').text(data['like']);
                      }
                      
             },'json');
          }
           })
           $('#like').click(function(){
             click(1);
           })
   
           destroy = function(id,obj,bj){
              confirm('确认删除？');
              $('#confirm div').eq(1).unbind("click").click(function(){
                    $.post('/home/article/comment/'+id,{'_token':$('input[name=_token]').val(),'auid':$('input[name=uid]').val(),'_method':'DELETE'},function(data){
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

           //错误消息
           function error(text)
            {
              $('#error').text(text).show();
              setTimeout(function(){
                $('#error').text('').hide();
              },2000);
            }

           //成功消息
           function success(text)
            {
              $('#success').text(text).show();
              setTimeout(function(){
                $('#success').text('').hide();
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
     </div> 
     <div class="article-comment">
      <div class="comment-title-cpt">
       <div>
        评论
        <span id="comment-content">({{ $num }}&nbsp;条)</span>
       </div>
      </div> 
      @if(session('user'))
      <div class="comment-list-group">
        @foreach($comment as $k=>$v)
                 <div class="comment-cpt">
                    <input type="hidden" name="parent_id" value="{{ $v->id }}">
                    <div class="comment-user-icon">
                     <a href="/home/personal/{{ $v->uid }}"><img src="{{ $v->User->face }}" /></a>
                    </div> 
                    <div class="comment-info">
                     <div class="comment-user-info">
                      <a href="/home/personal/{{ $v->uid }}">{{ $v->User->uname }}</a><span>　{{ $v->created_at }}</span> 
                      <span class="comment-reply" onclick="dododo({{ $v->id }},this);">回复</span> 
                      @if($v->uid == session('user')['id'] || session('user')['id'] == $article->uid)
                      <span class="comment-del" onclick="destroy({{ $v->id }},this,1)">删除</span> 
                      @else
                      <span class="comment-del report" onclick="report({{ $v->id }},'article_comment')">举报</span>
                      @endif
                     </div> 
                     <div class="comment-content">
                      {{ $v->content }}
                     </div> 
                     @if($v->children)
                     @foreach($v->children as $kk=>$vv)
                       <div class="comment-content-others">
                          <a href="/home/personal/{{ $vv->User->id }}" target="_blank">　{{ $vv->User->uname }}:</a>{{ $vv->content }}
                          @if($vv->uid == session('user')['id'] || session('user')['id'] == $article->uid)
                          <span class="comment-del delete" onclick="destroy({{ $vv->id }},this,2)">删除</span>
                          @else
                          <span class="comment-del report" onclick="report({{ $vv->id }},'article_comment')">举报</span>
                          @endif
                       </div>
                     @endforeach
                     @endif
                     <div class="com-textarea hidden">
                      <textarea name="reply" class="reply" id="replyTextarea" maxlength="30" placeholder="请输入回复内容"></textarea> 
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
         <a href="../user/user.html?uid=3404651"><img src="http://q.qlogo.cn/qqapp/100339551/8F7A508551FF3247337B3665F290B595/100" /></a>
        </div> 
        <div class="comment-info">
         <div class="comment-user-info">
          <a href="../user/user.html?uid=3404651">吱吱1453813691</a><span>2018-12-4 13:35</span> 
          <span class="comment-reply">回复</span>
          <span class="comment-del" style="display: none;">删除</span> 

          <span class="comment-del report" style="display: none;">举报</span>
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



<!--        <div class="common-more-btn" style="">
        查看更多评论
       </div> 
       <div class="no-more-data" style="display: none;">
        -&nbsp;已加载全部&nbsp;-
       </div>
      </div>  -->
      @if(!$comment)
      <div class="no-comment" style="">
        暂时没有评论，快和小伙伴互动吧 
      </div>
      @endif
     </div>
    @endif
    </div>
   </div>
  </div>
 </div>
@endsection