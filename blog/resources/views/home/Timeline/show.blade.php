@extends('home/layout/index')

@section('head')
	<link rel="stylesheet" type="text/css" href="/home/css/timeline.css">
@endsection

@section('content')
  <script type="text/javascript">
    $(function(){
      $('#comments').focus(function(){
        $(this).parent().addClass('has-value');
      }).blur(function(){
        $(this).parent().removeClass('has-value');
      })
      $('#denglu').click(function(){
        $('body').css('overflow','hidden');
        $('.login').css('display','block');
      })
      $('.close-login-box').click(function(){
        $('body').css('overflow','visible');
        $('.login').css('display','none');
      })

   
    })
  </script>
  <div style="height: 100%" class="m-timelineInfo-container">
   <div class="container">
    <div class="timeline-container"> 
     <div class="left-content">
    	<div class="timeline-author">
       <a href="../user/user.html?uid=4408715"  class=""><img src="{{ $data->User->face }}" /></a> 
       <a href="../user/user.html?uid=4408715"  class="">{{ $data->User->nickname }}</a> 
       <div>
        {{ $data->created_at }}
        @if( isset(session('user')['id']) ) 
          @if( session('user')['id'] == $data['uid'] )
            <div>
             <div class="del-btn" onclick="del_sp({{ $data->id }})">
              删除
             </div>
            </div>
          @else
          <div>
           <div class="del-btn">
            举报
           </div>
          </div>
          @endif
        @else 
        <div>
         <div class="del-btn">
          举报
         </div>
        </div>
        @endif
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
      @if( $data->like_ta )
       <div class="likes-cpt likes" onclick="like({{ $data->id }},this,1)">
         {{ $data->like }} 
       </div>
      @else
       <div class="likes-cpt" onclick="like({{ $data->id }},this,1)">
         {{ $data->like }} 
       </div>
      @endif 
      </div> 

      <div class="timeline-comment">

       <div class="is-login-cpt">
       @if( !session('user') )
        <div class="if-no-login">
          快来
         <a id="denglu" class="btn">登录</a>发表你的精彩评论啦 
        </div>
        @else 
        <div class="is-login">
         <textarea name="" id="comments" maxlength="360" placeholder="发表你的精彩评论啦"></textarea> 
         <div id="fabpl" class="btn">
          发表评论
         </div>
        </div>
        @endif
       </div>

      <div class="article-comment">
        <div class="comment-title-cpt">
         <div>
          评论 
          <span id="pinglun">(<font>{{ $pinglun }}</font>条)</span>
         </div>
        </div> 
          
          
            <div class="comment-list-group" @if( !$pinglun ) style="display:none;" @endif>
            @foreach( $comment as $k=>$v)
            <div class="comment-cpt">
              <div class="comment-user-icon">
                <a href="" target="_blank" class=""><img src="{{ $v->User->face }}" /></a>
              </div> 
              <div class="comment-info">
                <div class="comment-user-info">
                 <a href="" target="_blank" class=""> {{ $v->User->nickname }}</a>
                  {{ $v->time }}
                 <span class="comment-reply" onclick="huifu(this)">回复</span>
                  @if( isset(session('user')['id']) ) 
                    @if( session('user')['id'] == $v['uid'] ) 
                      <span class="comment-del" onclick="del_pl({{$v->id}},this)">删除</span> 
                    @endif
                  @endif
                 <span class="comment-number">0</span>
                  @if( isset(session('user')['id']) ) 
                    @if( session('user')['id'] !== $v['uid'] )  
                      <span class="comment-del report">举报</span>
                    @endif
                  @endif
                </div> 
                <div class="comment-content">
                 {{ $v->content }}
                </div> 
                <div class="com-textarea hidden">
                  <textarea name="" id="replyTextarea" maxlength="360" placeholder="请输入回复内容"></textarea> 
                  <div class="btn-group">
                    <div class="btn" id="fasong" onclick="fasong({{ $v->id }},{{ $v->tid }},this)">
                      发送
                    </div> 
                    <div class="btn-cancle" id="quxiao" onclick="quxiao(this)">
                      取消
                    </div>
                  </div>
                </div>
                  @foreach( $v->children as $kk => $vv )
                    <div class="comment-content-others">
                      <a href=" " target="_blank" class="">{{ $vv->User->nickname }}:</a>{{ $vv->content }}
                      @if( !isset(session('user')['id']) )
                          <span class="comment-del">举报</span>
                      @else 
                        @if( session('user')['id'] == $v['uid'])
                          <span class="comment-del">删除</span>
                        @else
                          <span class="comment-del">举报</span>
                        @endif
                      @endif
                    </div>
                  @endforeach
              </div>
            </div>
            @endforeach 
            <div class="common-more-btn" style="display: none;">
             查看更多评论
            </div> 
            <div class="no-more-data" style="display: none;">
             -&nbsp;已加载全部&nbsp;-
            </div>
            </div>
            <div class="no-comment" @if( $pinglun ) style="display:none;" @endif>
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
       @foreach($cate as $k=>$v)
        <div class="btn-tag">
         <a href="/home/timeline?cid={{ $v->id }}">{{ $v->name }}</a>
        </div>
        @endforeach
       </div>

      </div> 

      <div class="others-timeline">
       <div class="title-cpt">
        相关碎片
       </div> 

        <div class="img-group-cpt">
          @foreach($likeness as $k=>$v)
          <div class="card-timeline-cpt">
            @if( $v->image )
            <div class="card-top-img">
              <a href="/home/timeline/{{ $v->id }}" ><img src="{{ $v->image }}" /></a>
            </div>
           @endif 
           <div class="card-item">
            <div class="card-content">
             <a href="/home/timeline/{{ $v->id }}" >{{ $v-> content }}</a>
            </div>  
            <div class="card-user">
             <div class="card-user-info">
              <a href="" class=""><img src="{{ $v->face }}" width="" />{{ $v->nickname }}</a>
             </div>
             @if( $v->like ) 
              <div class="likes-cpt card-likes likes" onclick="like({{ $v->id }},this,0)"></div>
             @else
              <div class="likes-cpt card-likes" onclick="like({{ $v->id }},this,0)"></div>
             @endif
            </div>
           </div>
          </div>
          @endforeach

        </div>

      </div>
     </div>
  </div>
   </div> 
   <div class="back-top hidden"></div> 
  </div>
  <script type="text/javascript">
    del_sp = function(id){
      confirm('删除的内容不可找回, 确认删除?');
      $('#confirm>div:eq(1)').click(function(){
        $('.Confirm').addClass('hidden');
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        $.post('/home/timeline/'+id,{'_method':'DELETE'},function(msg){
          if( msg == 'success'){
            window.location.href='/home/timeline';
          }else{
            $('.Confirm').addClass('hidden');
            error('服务器错误,删除失败！');
          }
        },'html'); 
      })
    }
    huifu = function(obj){
      if( $(obj).parent().next().next().hasClass('hidden') ){
        val = $(obj).parent().next().next().removeClass('hidden').addClass('has-value');
      }else{
        $(obj).parent().parent().find('#replyTextarea').val('');
        $(obj).parent().next().next().addClass('hidden');
      } 
    }
    fasong = function(id,tid,obj){
      @if( !session('user') )
        error('请先登录');
        return;
      @endif
      content = $(obj).parent().parent().find('#replyTextarea').val();
      $.get('/home/timeline/huifu',{'tid':tid,'parent_id':id,'content':content},function(data){
        if(data.msg == 'empty'){
          error('请填写内容');
        }else if( data.msg == 'error' ){
          error('服务器错误,回复失败');
        }else{
          div = '<div class="comment-content-others"><a href=" " target="_blank" class="">'+data.nickname+':</a>'+data.content+'<span class="comment-del report" style="display: none;">举报</span> <span class="comment-del">删除</span></div>';
          $(obj).parent().parent().find('#replyTextarea').val('');
          $(obj).parent().parent().addClass('hidden');
          $(obj).parent().parent().after(div);
        }
      },'json');
    }
    quxiao = function(obj){
      $(obj).parent().parent().find('#replyTextarea').val('');
      $(obj).parent().parent().addClass('hidden');
    }
    del_pl = function(id,obj){
      confirm('删除的内容不可找回, 确认删除?');
      $('#confirm>div:eq(1)').unbind('click').click(function(){
        $('.Confirm').addClass('hidden');
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        $.post('/home/timeline/comment/'+id,{'_method':'DELETE'},function(msg){
          if( msg == 'success'){
            $(obj).parent().parent().parent().remove();
            var num = $('#pinglun font').text();num--;
            console.log(num);
            if( num == 0 ){
              $('.comment-list-group').css('display','none');
              $('.no-comment').css('display','block');
            }
            $('#pinglun font').text(num);
          }else{
            $('.Confirm').addClass('hidden');
            error('服务器错误,删除失败！');
          }
        },'html'); 
      })
    }
    $('#fabpl').click(function(){
      $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
      })
      $.post('/home/timeline/comment',{'content':$('#comments').val(),'tid':{{ $data['id'] }},'parent_id':'0' },function(data){
        if( data.msg == 'error'){
          error('服务器错误,评论失败');
        }else if( data.msg == 'empty' ){
          error('请输入内容');
        }else{
          var div = '<div class="comment-cpt"><div class="comment-user-icon"><a href="" target="_blank" class=""><img src="'+data.face+'" /></a></div><div class="comment-info"><div class="comment-user-info"><a href="" target="_blank" class="">'+data.nickname+'</a>'+data.time+'<span class="comment-reply" onclick="huifu(this)">回复</span> <span class="comment-del" onclick="del_pl('+data.id+',this)">删除</span> <span class="comment-number">0</span> <span class="comment-del report" style="display: none;">举报</span></div> <div class="comment-content">'+data.content+'</div> <div class="com-textarea hidden"><textarea name="" id="replyTextarea" maxlength="360" placeholder="请输入回复内容"></textarea> <div class="btn-group"><div class="btn" id="fasong" onclick="fasong('+data.id+',this)">发送</div> <div class="btn-cancle" id="quxiao" onclick="quxiao(this)">取消</div></div></div> </div></div>';
          $('.no-comment').css('display','none');
          $('.comment-list-group').css('display','block').prepend(div);
          $('#comments').val('');
          var num = $('#pinglun font').text();num++;
          $('#pinglun font').text(num);
        }
      },'json');
    })
  </script>




@endsection