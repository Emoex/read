<!DOCTYPE html>
<html lang="en">
 <head> 
  <meta charset="UTF-8" /> 
  <meta type="" /> 
  <title>嘻嘻嘻</title> 
  <script src="/assets/js/core/jquery.3.2.1.min.js"></script>
  <link href="https://qnstatic.pianke.me/public/assets/favicon.ico" rel="icon" type="image/x-icon" /> 
  <link rel="stylesheet" href="/css/client.css" />  
  <link rel="stylesheet" href="/css/radio.css" /> 
  <link rel="stylesheet" href="/assets/css/user.css">
  <link rel="stylesheet" href="/css/userSet.css">
  <link rel="stylesheet" href="/css/common.css">
  <link type="text/css" rel="stylesheet" href="/css/style.css">
  <!-- 瀑布流 --><script type="text/javascript" src="/js/minigrid.js"></script>
  <style>
    input::-webkit-input-placeholder {
      /* placeholder字体大小  */
      font-size: 8px;
    }
    .info{
      font-size: 5px;
    }
  </style>
  @section('head')
    
  @show
 </head> 
 <body  style="overflow: visible;"> 
  <a id="top"></a>
  <div pause-scroll-trigger="true" style="height: 100%" class="m-index-container">
   <div>

    <div class="login" style="display: none;">
      <div class="close-login-box"></div> 
      <div class="login-box">
        <div class="pianke-text"> 
          <font style="vertical-align: inherit;"><font style="vertical-align: inherit;">世界很美，而你正好有空</font></font> 
        </div>

        <div class="type-title-cpt"> 
         <span class="active"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">登录</font></font></span> 
         <span class=""><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">注册</font></font></span> 
        </div> 

        @if (session('error'))
          <div class="alert alert-danger alert-dismissible" role="alert" style="background:#fff;border:0px;margin-bottom:-8px;width:200px;margin-left:200px;font-size:12px;">
            <strong>{{ session('error') }}</strong> 
          </div>
          <script>
                 $('.login').css('display','block'); 
          </script>
          {{ session(['error'=>'']) }}
        @endif

        @if (count($errors) > 0)
         <div class="alert alert-danger" style="background:#fff;border:0px;margin-bottom:-8px;width:100px;margin-left:220px;font-size:12px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach  
            </ul>
         </div>
           <!-- <script>
                   $('.login').css('display','block'); 
            </script> -->
        @endif 

        <div class="login-content" style="display: block;"> 
          <div class="login-warn"></div> 
          <form action="/home/doLogin" method="post">
           {{ csrf_field() }}
           <div class="login-input"> 
            <input type="text" name="uname" placeholder="输入用户名" /> 
           </div> 
           <div class="login-input"> 
            <input type="password" name="pwd" placeholder="密码" /> 
           </div>  
           <label>
           <div class="login-btn"> 
            <font style="vertical-align: inherit;"><input id="denglu" type="submit" value="登录" style="outline:medium;display:inline-block;background:none;border:none;cursor:pointer;"></font>
           </div> 
           </label>
          </form>
        </div> 

        <div class="login-content" style="display: none;"> 
            <form action="/home/login" method="post" onsubmit="return false;" id="register_form">
           {{ csrf_field() }}
           <div class="login-input" style="margin-top:-20px;"> 
             <label for=""><span style="font-size:12px;">用户名</span><input type="text"  name="reuname" placeholder="4-10位字母开头字母数字" style="width:140px;"/> </label>
             <span class="info"></span>
           </div> 
           <div class="login-input" style="margin-top:-10px;"> 
             <label for=""><span style="font-size:12px;">手机号</span><input type="text" id="tel" name="tel" placeholder="请输入手机号" style="width:130px;"/> </label>
             <span class="info"></span>
           </div> 
           <div class="login-input" style="margin-top:-10px;"> 
            <label for=""><span style="font-size:12px;">密　码</span><input type="password" placeholder="6-15位字母数字下划线" name="repwd" style="width:140px;" /></label>
            <span class="info"></span>
           </div> 
           <div class="login-input" style="margin-top:-10px;"> 
            <label for=""><span style="font-size:12px;">验证码</span><input type="name" placeholder="验证码" name="code" style="width:80px;" /></label>
            <input type="button" style="width:100px;background:#eee;text-align:center;line-height:30px;font-size:14px;" id="yzm" value="获取" disabled="disabled">
            <span class="info"></span>
           </div> 
           <div style="clear:both"></div>
           <label>
           <div class="login-btn"> 
            <font style="vertical-align: inherit;"><input type="submit" id="register" value="注册" style="outline:medium;display:inline-block;background:none;border:none;cursor:pointer;"></font>
           </div> 
           </label>
           </form>
        </div> 
      </div>
    </div>

    <header class="" style="">
     <div class="head">
      <div class="head-logo">
       <a href=""></a>
      </div> 
      <ul class="navbar">
       <li class=""><a href="/home/index">首页</a></li> 
       <li class=""><a href="/home/article">阅读</a></li> 
       <li class=""><a href="/home/ting">电台</a></li> 
       <li class=""><a href="/home/timeline">碎片</a></li>
       @if(session('user')) 
       <li class=""><a href="/home/feed">动态</a></li>
       @endif 
      </ul> 
      <input type="hidden" name="active" value="{{ $active or 5}}">
      <script>
              $('.navbar li').eq($('input[name=active]').val()).addClass('active');
              $('.navbar li').click(function(){
                  $('.navbar li').removeClass('active');
                  $(this).addClass('active');
              })
      </script>
      <div class="navbar-icon">
          <a href="/home/article/create">
         <div class="editer">
          <div>
          <img src="http://qnstatic.pianke.me/public/assets/img/edit-icon.png" width="19px" height="20px" />         
          </div>
         </div> 
         </a> 
        @if(session('user'))
               <div class="userinfo">
                <a href="/home/personal/{{ session('user')['id'] }}">  @if(session('user')['face'])<img src="{{ session('user')['face'] }}" alt="" class="user-icon" id="face1"> @else <img src="/face.png" alt="" class="user-icon" > @endif </a> 
                <div class="msg-menu">
                 <div class="drop-menu userinfo-drop">
                  <ul>
                   <li><a href="/home/userinfo">账号设置</a></li> 
                   <li><a href="/home/logout">退出</a></li>
                  </ul>
                 </div>
                </div>
               </div> 
        @else
        <div class="login-btn"><div>登录&nbsp;<span>/</span>&nbsp;注册</div></div>
        @endif
      </div>
     </div>
    </header>
   </div> 
   <script>
    $(function(){
      var scrollHeight = 0;
      $(window).scroll(function(){
        if( $(window).scrollTop()>scrollHeight ){
          scrollHeight = $(window).scrollTop();
         $('header').attr('class','fade-leave-active');  
        }else{
          scrollHeight = $(window).scrollTop();
         $('header').attr('class','fade-enter-active');
        }
      })
      
      $('.login-btn').click(function(){
          $('.login').css('display','block');
          $('body').css('overflow','hidden');
      }) 
      $('.if-no-login').click(function(){
          $('.login').css('display','block');
          $('body').css('overflow','hidden');
      }) 
      $('.close-login-box').click(function(){
          $('.login').css('display','none');
          $('body').css('overflow','visible');
      })

          })
   </script>
   @section('content')



   @show
   <label><a href="#top"><div class="back-top"></div></a></label> 
   <footer>
    <div class="foot">
     <div class="foot-logo"></div> 
     <div class="foot-link">
      <span><a href="http://old.pianke.me/public/aboutus.php" target="_blank">关于我们</a> <a href="http://old.pianke.me/public/link.php" target="_blank">友情链接</a> <a href="http://old.pianke.me/public/help.php" target="_blank">片刻帮助</a> <a href="http://old.pianke.me/public/feedback.php" target="_blank">意见反馈</a> <a href="http://old.pianke.me/album/52a83abd7f8b9ab50d00000d" target="_blank">成长记忆</a><br /></span> 
      <span>All rights reserved &copy; 2016 pianke.me /黔ICP备17008875号-1</span>
     </div> 
     <div class="foot-icon">
      <div class="foot-app">
       <a href="../../pages/client/client.html"></a>
      </div> 
      <div class="foot-weibo">
       <a href="http://weibo.com/u/2848708205" target="_blank"></a>
      </div> 
      <div class="foot-wechat">
       <div></div>
      </div> 
      <div class="foot-safe">
       <a target="_blank" href="http://v.pinpaibao.com.cn/authenticate/cert/?site=pianke.me&amp;at=business"></a>
      </div>
     </div>
    </div>
   </footer>
  </div> 
<!-- 提示框 -->
<div ><div id="error" style="display:none;" class="errorPrompt Prompt"></div></div>
<div><div id='success' style="display:none;" class="successPrompt Prompt"></div></div>
  <div class="Confirm hidden">
<div></div>
    <div class="btn-group" id="confirm">
      <div>取消</div>
      <div>确认</div></div>
</div>

 </body>
<script>
  //确认删除框
  function confirm(text){
    $('.Confirm>div:eq(0)').text(text);
    $('.Confirm').removeClass('hidden');
    $('#confirm>div:eq(0)').click(function(){
      $('.Confirm').addClass('hidden');
    })
  }
  //失败调用的方法
  function error(text)
  {
    $('#error').text(text).show();
    setTimeout(function(){
      $('#error').text('').hide();
    },2000);
  }
    //碎片喜欢的方法
    like = function(id,obj,type){
      @if( !session('user') )
        error('请先登录');
        return;
      @endif
      $.get('/home/timeline/like',{'id':id},function(msg){
        if(msg == 'success1'){
          $(obj).addClass('likes');
          if( type ){
            var num = $(obj).text();
            num++;
            $(obj).text(num);
          }
        }else if( msg == 'success2'){
          $(obj).removeClass('likes');
          if( type ){
            var num = $(obj).text();
            num--;
            $(obj).text(num);
          }
        }else{
          error('服务器错误！');
        }
      },'html');
    }
  $('.type-title-cpt span').click(function(){
      $('.type-title-cpt span').removeClass('active');
      $(this).addClass('active');
      var index = $(this).index();
      $('.login-content').css('display','none');
      $('.login-content').eq(index).css('display','block');
  })

  $(document).ready(function(){
    var isuname,ispwd,iscode = false;

    var uname = $("input[name='reuname']").eq(0);
    var pwd = $("input[name='repwd']");
    var code = $("input[name='code']");
    var uname_val,pwd_val;
    uname.keyup(function(){
      uname_val = $(this).val();
      var uname_preg = /^[a-zA-Z]{1}[a-zA-Z\d]{3,9}$/;
      if(uname_preg.test(uname_val)){
        $('.info').eq(0).html('用户名格式正确');
        $.get('/home/login/isUname',{'uname':uname_val},function(msg){
            if(msg == 'success'){
               isuname = true;
            }else{
              isuname = false;
               $('.info').eq(0).html('用户名已存在');
            }
         },'html')
      }else{
        $('.info').eq(0).html('用户名格式不正确');
      }
    });
   
   pwd.keyup(function(){
      pwd_val = $(this).val();
      var pwd_preg = /^[\w]{6,15}$/;

      var arr = [];
      var number_preg = /[0-9]+/g;
      if(number_preg.test(pwd_val)){
        arr.push('数字');
      }

      var small_str_preg = /[a-z]+/g;
      if(small_str_preg.test(pwd_val)){
        arr.push('小写字母');
      }
      var big_str_preg = /[A-Z]+/g;
      if(big_str_preg.test(pwd_val)){
        arr.push('大写字母');
      }

      if(pwd_preg.test(pwd_val)){
        var str = '';
        switch(arr.length){
          case 1:str = '弱';break;
          case 2:str = '中';break;
          case 3:str = '强';
        }
        $('.info').eq(2).html('密码格式正确  '+str);
        ispwd = true;
      }else{
        $('.info').eq(2).html('密码格式不正确');
      }
    });

    code.keyup(function(){
       if(code.val().length == 4){
         $.get('/home/login/isCode',{'code':code.val()},function(msg){
            if(msg == 'success'){
               iscode = true;
            }else{
               $('.info').eq(3).html('填写错误');
            }
         },'html')
       }
    })

    var ordertime=60;  
    var timeleft=ordertime;
    var btn=$("#yzm");
    var tel=$("#tel");
    var reg = /^1[34578]\d{9}$/;  
    tel.keyup(function(){
      if (reg.test(tel.val())){
        $('.info').eq(1).html('手机号格式正确');
        btn.removeAttr("disabled");  
        btn.click(function(){
          $.get('/home/login/code',{'tel':tel.val()},function(msg){
            console.log(msg);
        },'json');

        })
        }
      else{
        $('.info').eq(1).html('手机号格式不正确');
        btn.attr("disabled",true);
         $('form').eq(1).attr('onsubmit','return true');
        }
    })

    $('#register').click(function(){
        if(isuname && ispwd && iscode){
          $('#register_form').attr('onsubmit','return true');
          $('#register_form').submit();
        }
    })


    //计时函数
    function timeCount(){
       timeleft-=1;
       if (timeleft>0){
       btn.val(timeleft+" 秒后重发");
       setTimeout(timeCount,1000);
       }
       else {
        btn.val("重新发送");
        timeleft=ordertime;   
        btn.removeAttr("disabled");
       }
     }

    //事件处理函数
    btn.on("click",function(){
      $(this).attr("disabled",true); 
      timeCount(this);
      })
    })
</script>
</html>