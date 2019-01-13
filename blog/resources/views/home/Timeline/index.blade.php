@extends('home/layout/index')

@section('head')
  <link rel="stylesheet" type="text/css" href="/home/css/timeline.css">
@endsection

@section('content')

  <div class="container">

  <div><div id='success' style="display:none;" class="successPrompt Prompt"></div></div>
    {{ csrf_field() }}
    <div class="publish-timeline">
     <div class="now-date">
      <span id="date">7</span>
      <span id="mouth" class="date-English">December</span>
     </div> 
     <div class="publist-content">
      <textarea name="content" id="textarea" maxlength="140" placeholder="这一刻，你想说什么？"></textarea> 
      <div class="timeline-othres">
       <div class="timeline-type">
        <span id="gongkai" class="active">公开</span>
        <span id="mimi" class="">秘密</span>
       </div> 
      <div id="upload-img" class="upload-img">
        图片
        <input id="profile" type="file" id="imgFile" /> 
        <div id="imgDiv" class="imgDiv" style="display: none;">
         <div id="uploadImg" class="uploadImg" style="background-image: url(&quot;&quot;);">
         </div> 
         <img id="closeUpImg" src="/home/images/closeUpImg.png" class="closeUp" style="display: block;" />
        </div>
       </div> 
      <div class="timeline-tag">
        <div id="addlabel" class="tag-icon">
          添加标签
        </div> 
        <span id="hiddenlabel" class="hidden"></span>
        <span id="hiddencate" class="hidden"></span>
        <div class="tag-menu">
         <div id="tag-drop" class="tag-drop" style="display:none;">
         @foreach($cate as $k=>$v)
          <div class="tag-cpt">
           <a>{{ $v->name }}</a>
          </div>
          @endforeach
         </div>
        </div>
      </div> 
       <div id="fabsp" class="btn timeline-btn">
        发布碎片
       </div> 
       <div class="timeline-word-number">
        <span id="zishu">0</span> 
        <span>/140 字</span>
       </div>
      </div>
     </div>
    </div> 


    <div class="timeline-type">
     <div class="title-cpt">
      热门标签
     </div> 
     <div class="timeline-list">
     @foreach($cate as $k=>$v)
      <div class="article-type-cpt">
       <a onclick="cate('{{ $v->name }}','{{ $v->id }}');"><img src="{{ $v->path }}" /><span class="type-bg"></span><span class="type-title">{{ $v->name }}</span><span class="type-des">{{ $v->timeline()->count() }}个</span></a>
      </div>
      @endforeach
     </div>
    </div> 
    <div class="timeline-list-group">
     <div id="all" class="title-cpt">
      全部碎片
     </div> 



     <div class="img-group-cpt" >

        <div data-index="" class="card-timeline-cpt" style="opacity: 1;display:none ;" >
           <div class="card-top-img">
            <a href="" target="_token"><img src="" class="lazy loaded" /></a>
           </div>
           <div class="card-item">
            <div class="card-content">
             <a href="" target="_token"></a>
            </div>  
            <div class="card-user">
             <div class="card-user-info">
              <a href="" target="_token" class=""><img src="" width="" /><span>诺xiao婉</span></a>
             </div> 
             <div class="likes-cpt card-likes"></div>
            </div>
           </div>
           
        </div> 

     </div> 

     <div class="no-more-data" style="display:none;">
      -&nbsp;已加载全部&nbsp;-
     </div> 
     <div class="loading" style="display:none;"></div>
    </div>
   </div> 
   <div class="back-top hidden"></div>

  <script type="text/javascript">
          //公开或者秘密
      $('#gongkai').click(function(){
        $(this).attr('class','active');
        $('#mimi').removeClass('active');
        $('#textarea').attr('placeholder','这一刻，你想说什么？');
        if( !$('#hiddenlabel').text() ){
          //tag-icon类 是显示的
          $('#addlabel').attr('class','tag-icon').text('添加标签');
        }else{
          $('#addlabel').attr('class','tag-icon').text($('#hiddenlabel').text());
        }
        $('#fabsp').text('发布碎片');
      })
      $('#mimi').click(function(){
        $(this).attr('class','active');
        $('#gongkai').removeClass('active');
        $('#textarea').attr('placeholder','以匿名的方式倾诉，我们会将你的秘密随机推送给5位陌生人。');  
         $('#tag-drop').hide();
         //tag-icon tagS类 是隐藏的
         $('#addlabel').attr('class','tag-icon tagS').text('秘密');
         $('#fabsp').text('匿名发布');
      })
      //添加或者关闭标签
      $('#addlabel').click(function(){
        if($('#tag-drop').css('display')=='none'){
          $('#tag-drop').css('display','block');
        }else{
          $('#tag-drop').css('display','none');
        }
      })
       //选择标签
      $('#tag-drop div a').click(function(){
        $('#addlabel').text($(this).text());
        $('#hiddenlabel').text($(this).text());
        $('#tag-drop').hide();
      })
      //计算文字数量 聚焦,失焦事件
      $('#textarea').on('input',function(){
        $('#zishu').text($(this).val().length);
      }).focus(function(){
        $(this).css('border','1px solid #78bc85');
      }).blur(function(){
        $(this).css('border','');
      });
      //图片的展示
      $('#profile').change(function(){
        var objUrl = getObjectURL(this.files[0]);
          if (objUrl) 
          { 
            $('#imgDiv').css('display','block');
            $('#uploadImg').css('background-image','url('+objUrl+')');
          }
      });
      //关闭图片
      $('#closeUpImg').click(function(){
        $('#profile').val(null);
        $('#imgDiv').css('display','none');
      })

      //图片展示方法
      function getObjectURL(file) 
      {
          var url = null ; 
          if (window.createObjectURL!=undefined) 
          { // basic
            url = window.createObjectURL(file) ;
          }
          else if (window.URL!=undefined) 
          {
            // mozilla(firefox)
            url = window.URL.createObjectURL(file) ;
          } 
          else if (window.webkitURL!=undefined) {
            // webkit or chrome
            url = window.webkitURL.createObjectURL(file) ;
          }
          return url ;
      }
      function success(text)
      {
          $('#success').text(text).show();
          $('#gongkai').attr('class','active');
          $('#mimi').removeClass('active');
           $('#addlabel').attr('class','tag-icon').text('添加标签');
          $('#textarea').val(null).attr('placeholder','这一刻，你想说什么？');
          $('#profile').val(null);
          $('#zishu').text(0);
          $('#imgDiv').css('display','none');
          $('#fabsp').text('发布碎片');

          setTimeout(function(){
            $('#success').text('').hide();
          },2000);
      }
      $('#fabsp').click(function(){
        @if( !session('user') )
          error('请先登录');
          return;
        @endif
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        var formData = new FormData();
        formData.append('cid',$('#addlabel').text());
        formData.append('uid','session');
        formData.append('profile', $('#profile')[0].files[0]);
        formData.append('content',$('textarea').val());
        $.ajax({
          type:'post',
          url:'/home/timeline',
          data:formData,
          processData: false,
          contentType: false,
          success:function(msg){
            if(msg == 'empty'){
              error('请输入内容');
            }else if(msg == 'Serror'){
              error('服务器错误');
            }else if(msg == 'success'){
              success('发布成功');
            }
          },
          dataType:'html'
        })
      })
      time();
      function time()
      {
          $('#date').text((new Date).getDate());
          switch( (new Date).getMonth() ){
            case 0: $('#mouth').text('January');break;
            case 1: $('#mouth').text('February');break;
            case 2: $('#mouth').text('March');break;
            case 3: $('#mouth').text('April');break;
            case 4: $('#mouth').text('May');break;
            case 5: $('#mouth').text('June');break;
            case 6: $('#mouth').text('July');break;
            case 7: $('#mouth').text('August');break;
            case 8: $('#mouth').text('September');break;
            case 9: $('#mouth').text('October');break;
            case 10: $('#mouth').text('November');break;
            case 11: $('#mouth').text('December');break;
          }   
      }
      
      
      var p = 1;
      var num = 30;
      var isLoad = false;
      var id;

      
      $('.card-top-img>a>img').on('load',function(){
        waterfall();
      })

      var scrollHeight = 0;

      $(window).scroll(function(){
        if( $(window).scrollTop()>scrollHeight ){
          scrollHeight = $(window).scrollTop();
         $('header').attr('class','fade-leave-active');  
        }else{
          scrollHeight = $(window).scrollTop();
         $('header').attr('class','fade-enter-active');
        }
        if(isLoad) return;
        if(checkscrollside()){
          if(id){
            getDatas(id);
          }else{
            getDatas();
          }
        }
      })
      $(window).on('beforeunload',function(){
        $(window).scrollTop(100);
      })
      
      function getDatas(cid=0){ 
        $.get('/home/timeline',{'p':p,'num':num,'cid':cid},function(data){
          if(data.msg != 'error'){
            $(data).each(function(key,val){
              var temp = $('.card-timeline-cpt:eq(0)').clone(true);
              $('.img-group-cpt').append(temp);
              temp.css('display','');
              temp.attr('data-index',key);
              if(val.image){    
                temp.find('.card-top-img>a>img').attr('src',val.image);
                temp.find('.card-top-img>a').attr('href','/home/timeline/'+val.id);
              }else{
                temp.find('.card-top-img').css('display','none');
              }
              temp.find('.card-content>a').attr('href','/home/timeline/'+val.id);
              temp.find('.card-content>a').text(val.content);
              temp.find('.card-user-info>a>span').text(val.nickname);
              temp.find('.card-user-info>a').attr('href',111);
              temp.find('.card-user-info>a>img').attr('src',val.face);
              if(val.like){
                temp.find('.likes-cpt').addClass('likes').click(function(){ like(val.id,this,0) });
              }else{
                temp.find('.likes-cpt').click(function(){ like(val.id,this,0) });
              }
              $('.img-group-cpt').append(temp);
            });
            p++;
            isLoad = false;
            waterfall();
          }else{
            $('.no-more-data').css('display','block');
          } 
        },'json');   
      }
      function waterfall()
      {
        //取得展示框对象
        var boxs = $( ".img-group-cpt>div:not(:first)" );
        // 一个块框的宽
        var w = boxs.eq(0).outerWidth()+11;
        //用于存储 每列中的所有块框相加的高度。
        var hArr=[];
        boxs.each( function( index, value ){
            var h = $(this).outerHeight()+11;
          
            if( index < 4 ){
                hArr[ index ] = h; //第一行中的num个块框 先添加进数组HArr
                $(this).css({
                  'top':'0px',
                  'left':index*w+'px',
                })  
            }else{
                var minH = Math.min.apply( null, hArr );//数组HArr中的最小值minH
                // console.log(minH);
                var minHIndex = $.inArray( minH, hArr );//查找到并返回他的索引值
                  $(this).css({
                    'top':minH+'px',
                    'left':minHIndex*w+'px',
                  });
                //数组 最小高元素的高 + 添加上的展示框[i]块框高
                hArr[ minHIndex ] += $(this).outerHeight()+11;//更新添加了块框后的列高
            }
        });
        $('.img-group-cpt').height(Math.max.apply( null,hArr ));
      }
      function checkscrollside()
      {
        //全文高度
        var documentHeight = $(document).height();
        //窗口高度
        var widthHeight = $(window).height();
        //滚动高度
        var scrollHeight = $(window).scrollTop();
        //计算底部距离
        var bottomHeight = documentHeight - widthHeight - scrollHeight;

        if(bottomHeight<=200){
          isLoad = true;
          return true;
        }else{
          return false;
        }
      }
      function cate(text,cid)
      {
        $('#all').text(text);
        $('.img-group-cpt>div:eq(0)').siblings().remove();
        id = cid;
        p = 1;
        $('no-more-data').css('display','none');
        getDatas(cid);
      }
  </script>
  @if( isset($cid) )
    <script>
        cate('{{ $name }}','{{ $cid }}')
    </script>
  @else
    <script>
        getDatas();
    </script>
  @endif
@endsection