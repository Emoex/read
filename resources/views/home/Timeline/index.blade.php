@extends('home/layout/index')

@section('head')
  <link rel="stylesheet" type="text/css" href="/home/css/timeline.css">
@endsection

@section('content')

</script>
  <script type="text/javascript">
    $(function(){
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
      //计算文字数量
      $('#textarea').on('input',function(){
        $('#zishu').text($(this).val().length);
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
      function error(text)
      {
          $('#error').text(text).show();
          setTimeout(function(){
            $('#error').text('').hide();
          },2000);
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
      $('#111').click(function(){
        $('header').slideToggle();
      })
      $('#fabsp').click(function(){
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        })
        var formData = new FormData();
        formData.append('cid','11');
        formData.append('uid','11');
        formData.append('profile', $('#profile')[0].files[0]);
        formData.append('content',$('textarea').val());
        $.ajax({
          type:'post',
          url:'/home/timeline',
          data:formData,
          processData: false,
          contentType: false,
          success:function(msg){
            if(msg == 'Kerror'){
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
      function time(){
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
      getDates();
      
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
          getDates();
        }
      })
      $(window).on('beforeunload',function(){
        $(window).scrollTop(100);
      })
      
      function getDates(){ 
        $.get('/home/timeline',{'p':p,'num':num},function(data){
          if(data.msg != 'error'){
            $(data).each(function(key,val){
              var temp = $('.card-timeline-cpt:eq(0)').clone(true);
              $('.img-group-cpt').append(temp);
              temp.css('display','');
              temp.attr('data-index',key);
              if(val.image){    
                temp.find('.card-top-img>a>img').attr('src','/uploads/'+val.image);
                temp.find('.card-top-img>a').attr('href','/home/timeline/'+val.id);
              }else{
                temp.find('.card-top-img').css('display','none');
              }
              temp.find('.card-content>a').attr('href','/home/timeline/'+val.id);
              temp.find('.card-content>a').text(val.content);
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
      function waterfall(){
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
        var index = $('.img-group-cpt>div').last().attr('data-index');
      }
      function checkscrollside(){
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

    })
  </script>
  <div class="container">
  
  <div ><div id="error" style="display:none;" class="errorPrompt Prompt"></div></div>
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
        <div class="tag-menu">
         <div id="tag-drop" class="tag-drop" style="display:none;">
          <div class="tag-cpt">
           <a>悄悄话</a>
          </div>
          <div class="tag-cpt">
           <a>戳心歌词</a>
          </div>
          <div class="tag-cpt">
           <a>一见钟情的句子</a>
          </div>
          <div class="tag-cpt">
           <a>电影截图＋经典台词</a>
          </div>
          <div class="tag-cpt">
           <a>黑白大片</a>
          </div>
          <div class="tag-cpt">
           <a>最美摘抄</a>
          </div>
          <div class="tag-cpt">
           <a>旧书摊</a>
          </div>
          <div class="tag-cpt">
           <a>看照片猜身高</a>
          </div>
          <div class="tag-cpt">
           <a>三行情书</a>
          </div>
          <div class="tag-cpt">
           <a>给力头像都在这</a>
          </div>
          <div class="tag-cpt">
           <a>自拍狂魔</a>
          </div>
          <div class="tag-cpt">
           <a>给诗歌配图</a>
          </div>
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
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/978b2fe39436aca13338894a2c862f27.jpg" /><span class="type-bg"></span><span class="type-title">悄悄话</span><span class="type-des">76824个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/4a62a188b2d203cf32acf4d5b2fa9ca2.jpg" /><span class="type-bg"></span><span class="type-title">戳心歌词</span><span class="type-des">7982个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/dbbf9e47457a9858d58e1ea19d2238f6.jpg" /><span class="type-bg"></span><span class="type-title">一见钟情的句子</span><span class="type-des">65047个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/c7ecd8adcd43f125118bf66edf101d47.jpg" /><span class="type-bg"></span><span class="type-title">电影截图＋经典台词</span><span class="type-des">14495个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/77975f3100b4bcdae2672cefbc078208.jpg" /><span class="type-bg"></span><span class="type-title">黑白大片</span><span class="type-des">2600个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/ff1b00e3d2211ad5a69d58609f094a36.jpg" /><span class="type-bg"></span><span class="type-title">最美摘抄</span><span class="type-des">31091个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/a873dfff3750461e8e0ffb0f1538260a.jpg" /><span class="type-bg"></span><span class="type-title">旧书摊</span><span class="type-des">6386个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/e67ba528fa42ff9c9c596438ca8a6a66.jpg" /><span class="type-bg"></span><span class="type-title">看照片猜身高</span><span class="type-des">2871个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/1d43cf1c5353d2ab670fa8d9660356b4.jpg" /><span class="type-bg"></span><span class="type-title">三行情书</span><span class="type-des">11673个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/17369554b8a66e9fce46c4b954fee24c.jpg" /><span class="type-bg"></span><span class="type-title">给力头像都在这</span><span class="type-des">3612个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/242e213f7ace24f2c1bfb5a59a3e1f8b.jpg" /><span class="type-bg"></span><span class="type-title">自拍狂魔</span><span class="type-des">7796个</span></a>
      </div>
      <div class="article-type-cpt">
       <a><img src="http://qnstatic.pianke.me/tagpic/826ad7855d2f45a6f417ab35ac2e5d22.jpg" /><span class="type-bg"></span><span class="type-title">给诗歌配图</span><span class="type-des">1120个</span></a>
      </div>
     </div>
    </div> 
    <div class="timeline-list-group">
     <div class="title-cpt">
      全部碎片
     </div> 




     <div class="img-group-cpt" >

        <div data-index="" class="card-timeline-cpt" style="opacity: 1;display:none ;" >
           <div class="card-top-img">
            <a href="" target="_blank"><img src="" class="lazy loaded" /></a>
           </div>
           <div class="card-item">
            <div class="card-content">
             <a href="" target="_blank"></a>
            </div>  
            <div class="card-user">
             <div class="card-user-info">
              <a href="" target="_blank" class=""><img src="" width="" />诺xiao婉</a>
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
@endsection