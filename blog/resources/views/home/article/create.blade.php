<html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <title>{{ $title or '嘻嘻嘻' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/common.css">
    <link href="https://qnstatic.pianke.me/editor/assets/favicon.ico" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/bootstrap.css">
    <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/bootbox.css">
    <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/cropper.css">
     <!-- <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/style.css?v=36"> -->
     <link rel="stylesheet" href="/css/text.css">
    <script src="https://qnstatic.pianke.me/editor/assets/js/jquery.min.js"></script>
    <script src="https://qnstatic.pianke.me/editor/assets/php/lang/zh-cn/zh-cn.js" type="text/javascript" defer="defer"></script>
    <link href="https://qnstatic.pianke.me/editor/assets/php/themes/default/css/ueditor.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" defer="defer" src="https://qnstatic.pianke.me/editor/assets/php/php/controller.php?action=config&amp;callback=bd__editor__rltc25"></script>
    <script src="https://qnstatic.pianke.me/editor/assets/php/third-party/codemirror/codemirror.js" type="text/javascript" defer="defer"></script>
    <link rel="stylesheet" type="text/css" href="https://qnstatic.pianke.me/editor/assets/php/third-party/codemirror/codemirror.css">
    <script src="https://qnstatic.pianke.me/editor/assets/php/third-party/zeroclipboard/ZeroClipboard.js" type="text/javascript" defer="defer"></script>
  </head>
  <body style="background:#fff">
   <div class="menuBar hidden-xs"> 
   <div class="logo"> 
    <a href="/home/index"> <img width="18px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/logo.png" /></a> 
   </div> 
   <div class="menuItem"> 
    <a href="/home/article/create" class="active">文章</a> 
    <a href="/home/ting/create">Ting</a> 
    <a href="#!/rootEdit" style="display: none;">管理</a>
   </div> 
   <div class="userInfo hidden-xs-hg"> 
    <div class="userIcon"> 
     <a href="/home/personal/{{ session('user')['id'] }}"> <img class="userIconWH" src="{{ session('user')['face'] }}" /></a> 
    </div> 
    <hr /> 
    <div class="dropdown dropup"> 
     <a href="" class="dropdown-toggle" data-toggle="dropdown">账号</a> 
     <ul class="dropdown-menu dropMenu"> 
      <li> <a href="/home/userinfo">账号设置</a></li> 
     </ul> 
    </div> 
   </div> 
  </div> 
  <form action="/home/article" method="post" id="form">
  <!-- 发表 --> 
  <div class="articlecontent" style="padding-left:65px;padding-right:30px;margin-top:-35px;width:100%"> 
   
       {{ csrf_field() }}
       <div class="text-center ueditoButton pull-right" style="padding-top:30px;"> 

        <input type="submit" value='立即发布' style="background-color:#5BAD6B;border: 0px;color:#fff;width:90px;height:39px;" id="create">
       </div> 
       <div class="articleTitle"> 
        <div> 
         <input type="text" maxlength="20" name="title" placeholder="请输入标题" style="font-size:17px;" value="{{ old('title') }}" /> 
        </div> 
        <div class="titleWord text-center pull-right" style="width:100px;"> 
            最长20个字 
        </div> 
       </div> 
       <hr class="articleTitleHr" /> 
       <div class="articleType"> 
        <div class="dropdown dropdownType" style="margin-right:30px;"> 
         <a href="" class="dropdown-toggle" data-toggle="dropdown" style="color:#999;"> <span>选择分类</span> <img width="11px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/downpoint.png" /> </a> 
         <input type="hidden" value="" name="cname">
         <ul class="dropdown-menu dropMenuDownpoint"> 
          @foreach($cate as $k=>$v)
          <li class="tagLi"> <a>{{ $v->name }}</a> </li> 
          @endforeach
         </ul> 
         

        </div> 

       </div> 
       <!-- 发表结束 --> 
       <div style=""> 
        <script id="container" name="content" type="text/plain" style="height:400px"></script> 
       </div>
         
      </div> 
   </form> 
   <script src="https://qnstatic.pianke.me/editor/editorBuild/common.js?v=37"></script> 
   <script src="https://qnstatic.pianke.me/editor/editorBuild/build.js?v=37"></script> 
   <script src="https://qnstatic.pianke.me/editor/assets/js/bootstrap.min.js"></script> 
   <script src="https://qnstatic.pianke.meeditor/assets/js/bootbox.js"></script> 
   <div id="edui_fixedlayer" class="edui-default" style="position: fixed; left: 0px; top: 0px; width: 0px; height: 0px;"> 
    <div id="edui2" class="edui-popup  edui-bubble edui-default" onmousedown="return false;" style="display: none;"> 
     <div id="edui2_body" class="edui-popup-body edui-default"> 
      <iframe style="position:absolute;z-index:-1;left:0;top:0;background-color: transparent;" frameborder="0" width="100%" height="100%" src="about:blank" class="edui-default"></iframe> 
      <div class="edui-shadow edui-default"></div> 
      <div id="edui2_content" class="edui-popup-content edui-default"></div> 
     </div> 
    </div> 
   </div>
  </div>
        <!-- 配置文件 -->
    <script type="text/javascript" src="/utf8/ueditor.config.js"></script>
    <!-- 编辑器源码文件 -->
    <script type="text/javascript" src="/utf8/ueditor.all.js"></script>
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container',{toolbars: [['bold','fullscreen', 'source', 'undo', 'redo','simpleupload','underline','strikethrough','fontfamily','fontsize','justifyleft', 'justifyright','justifycenter','justifyjustify','forecolor','autotypeset']]});
    </script>
        <!-- 提示框 -->
    <div ><div id="error" style="display:none;" class="errorPrompt Prompt"></div></div>
    <div><div id='success' style="display:none;" class="successPrompt Prompt"></div></div>
    {{ csrf_field() }}
  </body>

  <script>
         $(function(){
             $('.tagLi a').click(function(){
                $('.dropdown-toggle span').html($(this).html());
                $('input[name=cname]').val($(this).html());
             });
            
             $('#create').click(function(){
                 var title = $('input[name=title]').val();
                 var cate = $('.dropdown-toggle span').html();
                 if(!title){
                   $('#form').attr('onsubmit','return false');
                   error('标题不能为空');
                 }
                 if(cate == '选择分类'){
                  $('#form').attr('onsubmit','return false');
                   error('请选择分类');
                 }
                 if(title && cate != '选择分类'){
                  $('#form').attr('onsubmit','return true');
                 }
                 
             })



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
         })
  </script>
</html>