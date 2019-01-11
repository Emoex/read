<!DOCTYPE html>
<html lang="en">
 <head> 
  <meta charset="UTF-8" /> 
  <meta type="" /> 
  <title>嘻嘻嘻</title> 
  <script type="text/javascript" src="/home/js/jquery.3.2.1.min.js"></script>
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
 <body style="overflow: visible;">

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
        @endif

        @if (count($errors) > 0)
         <div class="alert alert-danger" style="background:#fff;border:0px;margin-bottom:-8px;width:100px;margin-left:220px;font-size:12px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach  
            </ul>
         </div>
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
           <div class="forget-psw"> 
            <a href="../../pages/set/getCaptcha.html?type=2"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">忘记密码？</font></font></a> 
           </div> 
           <label>
           <div class="login-btn"> 
            <font style="vertical-align: inherit;"><input type="submit" value="登录" style="outline:medium;display:inline-block;background:none;border:none;cursor:pointer;"></font>
           </div> 
           </label>
          </form>
        </div> 

        <div class="login-content" style="display: none;"> 
            <form action="/home/login" method="post">
           {{ csrf_field() }}
           <div class="login-input" style="margin-top:-20px;"> 
             <label for=""><span style="font-size:12px;">用户名</span><input type="text"  name="uname" placeholder="4-10位字母开头字母数字组合" style="width:140px;"/> </label>
             <span class="info"></span>
           </div> 
           <div class="login-input" style="margin-top:-10px;"> 
             <label for=""><span style="font-size:12px;">手机号</span><input type="text" id="tel" name="tel" placeholder="请输入手机号" style="width:130px;"/> </label>
             <span class="info"></span>
           </div> 
           <div class="login-input" style="margin-top:-10px;"> 
            <label for=""><span style="font-size:12px;">密　码</span><input type="password" placeholder="6-15位字母数字下划线" name="pwd" style="width:140px;" /></label>
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
       <li class=""><a href="/home/feed">动态</a></li> 
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
       <div class="massage">
        <div class="msg-icon">
         <img src="http://qnstatic.pianke.me/public/assets/img/msg.png" width="44px" /> 
         <div class="msgnum">
          4
         </div>
        </div> 
        <div class="msg-menu">
         <div class="drop-menu msg-drop">
          <ul>
           <li><a href="../../pages/user/user.html?uid=4764921&amp;msgType=0">评论 <span>0</span></a></li> 
           <li><a href="../../pages/user/user.html?uid=4764921&amp;msgType=1">喜欢 <span>1</span></a></li> 
           <li><a href="../../pages/user/user.html?uid=4764921&amp;msgType=2">粉丝 <span>0</span></a></li> 
           <li><a href="../../pages/user/user.html?uid=4764921&amp;msgType=3">片邮 <span>3</span></a></li>
          </ul>
         </div>
        </div>
       </div> 
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
        <a href="/home/login"><div class="login-btn"><div>登录&nbsp;<span>/</span>&nbsp;注册</div></div></a>
        @endif
       <div class="login-btn hidden">
        <div>
         登录&nbsp;
         <span>/</span>&nbsp;注册
        </div>
       </div>
      </div>
     </div>
    </header>

   </div> 
   @section('content')


   @show
   <div class="back-top"></div> 
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
   <div ><div id="error" style="display:none;" class="errorPrompt Prompt"></div></div><!-- 确认框 -->
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
  //碎片喜欢的方法
  like = function(id,obj,type){
    @if( !session('user') )
      error('请先登录');
      return;
    @endif
    $.get('/home/timeline/like',{'id':id},function(msg){
      if(msg == 'success'){
        $(obj).addClass('likes');
        if( type ){
          var num = $(obj).text();
          num++;
          $(obj).text(num);
        }
      }else{
        $(obj).removeClass('likes');
        if( type ){
          var num = $(obj).text();
          num--;
          $(obj).text(num);
        }
      }
    },'html');
  }
  //失败调用的方法
  function error(text)
  {
    $('#error').text(text).show();
    setTimeout(function(){
      $('#error').text('').hide();
    },2000);
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

    var uname = $("input[name='uname']").eq(0);
    var pwd = $("input[name='pwd']");
    var code = $("input[name='code']");

    uname.keyup(function(){
      var uname = $(this).val();
      // var uname_preg = /^[a-zA-Z\d\u4e00-\u9fa5]{4,10}$/;
      var uname_preg = /^[a-zA-Z]{1}[a-zA-Z\d]{3,9}$/;
      if(uname_preg.test(uname)){
        $('.info').eq(0).html('用户名格式正确');
        isuname = true;
      }else{
        $('.info').eq(0).html('用户名格式不正确');
      }
    });
   
   pwd.keyup(function(){
      var pwd = $(this).val();
      var pwd_preg = /^[\w]{6,15}$/;

      var arr = [];
      var number_preg = /[0-9]+/g;
      if(number_preg.test(pwd)){
        arr.push('数字');
      }

      var small_str_preg = /[a-z]+/g;
      if(small_str_preg.test(pwd)){
        arr.push('小写字母');
      }
      var big_str_preg = /[A-Z]+/g;
      if(big_str_preg.test(pwd)){
        arr.push('大写字母');
      }

      if(pwd_preg.test(pwd)){
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

    var ordertime=60;  
    var timeleft=ordertime;
    var btn=$("#yzm");
    var tel=$("#tel");
    var reg = /^1[0-9]{10}$/;  
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
      }
    })
    $('#register').click(function(){
      if(code.val()){
      iscode = true;
    }
      if(isuname && ispwd){
        return true;
      }else{
        return false;
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