<html lang="en">
 <head> 
  <meta charset="UTF-8" /> 
  <title>片刻</title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <link href="https://qnstatic.pianke.me/editor/assets/favicon.ico" rel="icon" type="image/x-icon" /> 
  <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/bootstrap.css" /> 
  <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/bootbox.css" /> 
  <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/cropper.css" /> 
  <link rel="stylesheet" href="https://qnstatic.pianke.me/editor/assets/css/style.css?v=36" /> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/jquery.min.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/md5.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/jquery.base64.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/common.js?v=37"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/cropper.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/php/ueditor.config.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/php/ueditor.all.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/qiniu.js?v=37"></script> 
  <script type="text/javascript" charset="utf-8" async="" src="https://qnstatic.pianke.me/editor/editorBuild/2.build.js"></script>
 </head> 
 <body> 
 <div id="article"></div>
 <script>
        $(function(){
          $('#article').load('article');
        })
 </script>
  <div class="menuBar hidden-xs"> 
   <div class="logo">
    <a href="http://pianke.me/"><img width="18px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/logo.png" /></a>
   </div> 
   <div class="menuItem"> 
    <a href="/home/article/create">文章</a> 
    <a href="#!/ting" class="v-link-active active">Ting</a> 
    <a href="#!/rootEdit" style="display: none;">管理</a> 
   </div> 
   <div class="userInfo hidden-xs-hg"> 
    <div class="userIcon"> 
     <a href="http://pianke.me/profile/4764921"> <img class="userIconWH" src="http://thirdwx.qlogo.cn/mmopen/vi_32/1ticCtULhM44n9f8ghgNCWcac62HEJ8UfAt3CdiaASibBxPrIJrlLtibURmlY4GIYRnn4iasouuhYlXhVAVxic3iadAWw/132" /> </a> 
    </div> 
    <hr /> 
    <div class="dropdown dropup"> 
     <a href="" class="dropdown-toggle" data-toggle="dropdown">账号</a> 
     <ul class="dropdown-menu dropMenu"> 
      <li> <a href="http://tweb.pianke.me/pages/set/userSet.html">账号设置</a> <a href="http://tweb.pianke.me/pages/user/user.html?uid=500129&amp;msgType=0">消息中心</a> <a href="http://tweb.pianke.me/pages/index/index.html">返回</a> </li> 
     </ul> 
    </div> 
   </div> 
  </div> 
  <div class="menuBar-xs visible-xs"> 
   <div class="logo-xs">
    <a href=""><img width="18px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/logo.png" /></a>
   </div> 
   <div class="menuItem-xs hidden-menu"> 
    <a href="#!/article">文章</a> 
    <a href="#!/ting" class="v-link-active active">Ting</a> 
   </div> 
   <div class="userInfo-xs pull-right hidden-xs-wd"> 
    <div class="userIcon"> 
     <a href="http://pianke.me/profile/4764921"> <img class="userIconWH" src="http://thirdwx.qlogo.cn/mmopen/vi_32/1ticCtULhM44n9f8ghgNCWcac62HEJ8UfAt3CdiaASibBxPrIJrlLtibURmlY4GIYRnn4iasouuhYlXhVAVxic3iadAWw/132" /> </a> 
    </div> 
    <div class="dropdown dropup-xs"> 
     <a href="" class="dropdown-toggle" data-toggle="dropdown">账号</a> 
     <ul class="dropdown-menu dropMenu-xs"> 
      <li> <a href="http://tweb.pianke.me/pages/set/userSet.html">账号设置</a> <a href="http://tweb.pianke.me/pages/user/user.html?uid=500129&amp;msgType=0">消息中心</a> <a href="http://tweb.pianke.me/pages/index/index.html">返回</a> </li> 
     </ul> 
    </div> 
   </div> 
  </div> 
  <div class="alertMask uhide"> 
   <div class="maskContent"> 
    <div class="line-1"> 
     <div class="imgTitle">
      添加封面
     </div> 
     <div class="imgClose">
      <img width="22px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/closeAlert.png" />
     </div> 
    </div> 
    <div class="line-2"> 
     <div class="line2Left"> 
      <div class="noImgUrl"> 
       <div class="noImgBtn"> 
        <input accept="image/*" type="file" class="insertTing insertImg" value="" id="imgFile1" name="file" /> 
        <img width="15px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/addImg.png" />选择图片 
       </div> 
       <div class="noImgText">
        建议尺寸640x640 宽:高 = 1:1
       </div> 
      </div> 
     </div> 
     <div class="line2Right"> 
      <div class="rightTop"> 
       <div class="topText">
        预览
       </div> 
       <div class="topImg img-preview"> 
       </div> 
      </div> 
      <div class="btn-rchose">
       <input accept="image/*" type="file" class="insertTing" value="" id="imgFile2" name="file" />重新选择
      </div> 
     </div> 
    </div> 
    <div class="line-3"> 
     <div class="btn-close3">
      取消
     </div> 
     <div class="btn-sure3">
      确定
     </div> 
    </div> 
   </div> 
  </div> 
<!-- 发表电台 -->
  <form action="/home/ting" method="post" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="container-bg"> 
   <div class="container"> 
    <div class="row"> 
     <div class="col-sm-2"> 
      <div class="newCollection"> 
       <div class="newColl newItem"> 
        <img class="collectionIcon" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/collection.png" /> 
        <span>创建片刊</span> 
       </div> 
       <div class="collectionInfo uhide"> 
        <input type="text" placeholder="请输入片刊名称" autofocus="autofocus" id="colloectionName" maxlength="20" /> 
        <div class="buttonGroup text-center ut-s"> 
         <span class="buttonGroupNoHover">取消</span> 
         <span class="buttonGroupNoHover">确定</span> 
        </div> 
       </div> 
      </div> 
      <div class="collectionList"> 
       <p class="uhide getMore">加载更多</p> 
      </div> 
     </div> 
     <div class="col-sm-3 middleContent"> 
      <div class="newCollection"> 
       <div class="newItem"> 
        <img class="newTing" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/ting.png" /> 
        <span>新建Ting</span> 
       </div> 
      </div> 
      <div class="articleList"> 
       <p class="uhide getMore">加载更多</p> 
      </div> 
     </div> 
     <div class="col-sm-7"> 
      <div class="logoDefault uhide">
       <img class="center-block" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/logoDefault.png" />
      </div> 
      <div class="articlecontent"> 
       <div class="text-center ueditoButton pull-right"> 
        <span class="preview">保存</span> 

        <input type="submit" value='提交'>
       </div> 
       <div class="articleTitle tingTitle"> 
        <div>
         <input type="text" name='title' maxlength="30"  value="" placeholder="请输入标题" />
        </div> 
       </div> 
       <hr class="tingTitleHr" /> 
       <div class="articleType tingType"> 
         
        <div class="dropdown dropdownType"> 
        <!--  <a href="" class="dropdown-toggle" data-toggle="dropdown" style="color:#999"> <span>选择分类</span> <img width="11px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/downpoint.png" /> </a> 
        <ul class="dropdown-menu dropMenuDownpoint dropMenuDownpointTing"> 
        @foreach($cate as $k=>$v)
         <li class="tagLi"> <a>{{ $v->name }}</a></li> 
         @endforeach
        </ul>  -->
        <select name="cate" class="dropdown-toggle" id="">
            @foreach($cate as $k=>$v)
            <option value="{{ $v->id }}">{{ $v->name }}</option>
            @endforeach
        </select>
        </div> 

       </div> 
       <div class="tingContent container"> 
        <div class="row"> 
         <div class="col-xs-3 col-sm-3 leftCont"> 
          <label><img src="http://pianke.image.alimmdn.com/webUeditor/assets/img/uploadImgD.png" />
          <input type="file" name='img' value="" style="display: none"></label> 
          <div class="uploadText">
           请上传封面, 建议尺寸640x640
          </div> 
          <div class="uploadText uploadTexttwo">
           宽:高 = 1:1
          </div> 
          <div class="btnUploadImg">
           编辑封面
          </div> 
         </div> 
         <div class="col-xs-9 col-sm-9 rightCont"> 
          <div class="btnUploadFile"> 
           <img class="addAudio" width="15px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/addAudio.png" /> 
           <input type="file" class="insertTing" value="" id="file1" name="file" /> 上传录制文件 
           
          </div> 
          <div class="btnUploadFile2"> 
           <div style="text-overflow:ellipsis;overflow:hidden;margin:0 40px"> 
           </div> 
           <div> 
            <img class="addAudio" width="15px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/addAudio2.png" /> 
            <input type="file" class="insertTing2" id="file2" name="file1" /> 
           </div> 
          </div> 
          <div class="uploadFText">
           文件暂时只支持MP3, 单个文件请不要超过30M
          </div> 
          <div class="articleCon ushow"> 
           <div class="btnUploadArticle"> 
            <img class="addAudio" width="10px" src="http://pianke.image.alimmdn.com/webUeditor/assets/img/addArticle.png" /> 添加文章链接 
           </div> 
           <div class="abortTing">
             1. 此处添加的文章为Ting的对应文案, 供大家在收听电台时阅读;
            <br /> 2. 只支持片刻站内链接, 文章可以为站内作者的文章或自己发布的文章。
            <br />
            <br /> 如果您还有其他的问题, 请阅读
            <a href="http://pianke.me/posts/57fb33ef02334daa4cd01d34" target="_blank">「片刻ting投稿指南」</a>, 也可私信电台编辑
            <a href="http://pianke.me/profile/550036/" target="_blank">「pianketing」</a>。
            <br /> 
           </div> 
          </div> 
          <div class="articleCon uhide"> 
           <div class="articleAuthor"> 
            <div>
             文: 
             <span class="author"></span>
            </div> 
            <div class="btnAuthor">
             替换文章链接
            </div> 
           </div> 
           <div class="contentHtml"> 
           </div> 
          </div> 
         </div> 
        </div> 
       </div> 
      </div> 
     </div> 
    </div> 
   </div> 
  </div> 
  </form>
  <script src="https://qnstatic.pianke.me/editor/editorBuild/common.js?v=37"></script> 
  <script src="https://qnstatic.pianke.me/editor/editorBuild/build.js?v=37"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/bootstrap.min.js"></script> 
  <script src="https://qnstatic.pianke.me/editor/assets/js/bootbox.js"></script> 
 </body>
</html>