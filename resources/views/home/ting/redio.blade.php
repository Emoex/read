@extends('home/layout/index')
@section('content')

   <div class="container">
    <div class="radio-type">
     <div class="type-title-cpt">
      <span class="active">精选</span> 
      <span class="">全部电台</span>
     </div>
    </div> 
    <div class="choice-radio">
     <div class="slide-cpt radio-slide-cpt">
      <div class="banner-btn left-btn"></div> 
     <div class="banner-img-box">
       <ul class="img-group">
        <li data-index="0" style="width: 640px; height: 375px; top: 0px; left: 150px; z-index: 8;" class="active"><a href="/pages/radio/tingInfo.html?tingid=591405816117b30127288ee9" target="_blank"><img src="http://hpimg.pianke.com/19cfeb13c5f71e01d57ef78ab29cc59820170511.jpg" /></a></li>
        <li data-index="1" style="width: 493px; height: 289px; top: 33px; left: 0px; z-index: 6;"><a href="/pages/radio/tingInfo.html?tingid=58e5e0b95028fc3a6876ebab" target="_blank"><img src="http://hpimg.pianke.com/70141776893d405dead9bfc09552059420170426.jpg" /></a></li>
        <li data-index="2" style="width: 493px; height: 289px; top: 33px; left: 467px; z-index: 6;"><a href="/pages/radio/tingInfo.html?tingid=58f2fa805715def043844d33" target="_blank"><img src="http://hpimg.pianke.com/7164a70cf60d3e085c814d6ffbf2b18720170417.jpg" /></a></li>
       </ul> 
       <div class="banner-line" style="width: 108px;">
        <div style="left: 0px;"></div>
       </div>
      </div> 
      <div class="banner-btn right-btn"></div>
<!-- <script type="text/javascript">
   var i=$('.img-group li').index();
  $('.left-btn').click(function(){
      console.log(i);
      i--;
      if(i<0){
        i=2;
      }
      
      if(i==2){
        $('.img-group li').eq(i).animate({'width':'640px','height':'375px','top':'0px','left':'150px','z-index':'8'});
        $('.img-group li').eq(i).addClass('active');
        $('.img-group li').eq(i-1).animate({'width':'493px','height':'289px','top':'33px','left':'0px','z-index':'6'});
        $('.img-group li').eq(0).animate({'width':'493px','height':'289px','top':'33px','left':'467px','z-index':'6'});
      }
      if(i==0){
        $('.img-group li').eq(i).animate({'width':'640px','height':'375px','top':'0px','left':'150px','z-index':'8'});
        $('.img-group li').eq(i).addClass('active');
        $('.img-group li').eq(i-1).animate({'width':'493px','height':'289px','top':'33px','left':'0px','z-index':'6'});
        $('.img-group li').eq(2).animate({'width':'493px','height':'289px','top':'33px','left':'467px','z-index':'6'});
      }
      if(i==1){
        $('.img-group li').eq(i).animate({'width':'640px','height':'375px','top':'0px','left':'150px','z-index':'8'});
        $('.img-group li').eq(i).addClass('active');
        $('.img-group li').eq(0).animate({'width':'493px','height':'289px','top':'33px','left':'0px','z-index':'6'});
        $('.img-group li').eq(2).animate({'width':'493px','height':'289px','top':'33px','left':'467px','z-index':'6'});
      }
      
       
  })
</script> -->
     


     <div class="index-content">
      <div class="radio-type-group">
      @foreach($cate as $k=>$v)
       <div class="radio-type-cpt">
        <a href="/home/ting/{{$v->id}}/edit"><img src="{{ $v->path }}" width="25px" />{{ $v->name}}</a>
       </div>
       @endforeach
      </div> 
<!-- 电台推荐 -->
      <div class="ting-list-group">
       <div class="title-cpt">
        推荐TING&nbsp;|&nbsp;Recommendation TING
       </div> 
       <div class="ting-list">
          @foreach($listen as $k=>$v)
          
            <div class="ting-cpt">
              
             <div class="ting-img">
              <a href="/home/ting/{{ $v->id }}" target="_blank"><img src="{{ $v->img }}" class="lazy" /> <span></span></a>
             </div> 
             <div class="ting-info">
              <div class="ting-title">
               <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a>
              </div> 
              <div class="ting-author">
               <a href="/pages/user/user.html?uid=296663" target="_blank">主播&nbsp;/&nbsp;{{$v->tname}}</a>
              </div> 
              <div class="ting-others">
               {{ $v->listen }}k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:32&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->likes }}
              </div>
             </div>
            </div>
          @endforeach

       </div>
      </div> 
<!-- 电台推荐结束 -->
<!-- 最热电台 -->
      <div class="ting-list-group">
       <div class="title-cpt">
        TOP TING
       </div> 
       <div class="ting-list">
       @foreach($like as $k=>$v)
        <div class="ting-cpt">
         <div class="ting-img">
          <a href="/home/ting/{{ $v->id }}" target="_blank"><img src="{{ $v->img }}" /> <span></span></a>
         </div> 
         <div class="ting-info">
          <div class="ting-title">
           <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a>
          </div> 
          <div class="ting-author">
           <a href="/pages/user/user.html?uid=716849" target="_blank">主播&nbsp;/&nbsp;{{ $v->tname }}</a>
          </div> 
          <div class="ting-others">
           {{ $v->listen }}k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:0&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->likes }} 
          </div>
         </div>
        </div>
       @endforeach
       </div>
      </div> 
<!-- 最热电台结束 -->
<!-- 最新发声 -->
     
      <div class="ting-list-group radio-ting-list">
       <div class="title-cpt">
        最新发声&nbsp;|&nbsp;New Voice
       </div> 
       <div class="ting-list">
         @foreach($tingid as $k=>$v)
        <div class="ting-cpt">
         <div class="ting-img">
          <a href="/home/ting/{{ $v->id }}" target="_blank"><img src="{{ $v->img }}" class="lazy" /> <span></span></a>
         </div> 
         <div class="ting-info">
          <div class="ting-title">
           <a href="/home/ting/{{ $v->id }}" target="_blank">{{ $v->title }}</a>
          </div> 
          <div class="ting-author">
           <a href="/pages/user/user.html?uid=4255398" target="_blank">主播&nbsp;/&nbsp;{{ $v->tname }}</a>
          </div> 
          <div class="ting-others">
           {{ $v->listen }}次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:2&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:{{ $v->likes }} 
          </div>
         </div>
        </div>
         @endforeach
       </div>
      
      </div>
      
<!-- 最新发声结束 -->
     </div>
    </div> 
    <div class="all-radio" style="display: none;">
     <div class="index-content">
      <div class="radio-type-link">
        分类: 
       <a href="/pages/radio/radioType.html?type=2">故事</a> 
       <a href="/pages/radio/radioType.html?type=4">音乐</a> 
       <a href="/pages/radio/radioType.html?type=6">读诗</a> 
       <a href="/pages/radio/radioType.html?type=5">电影</a> 
       <a href="/pages/radio/radioType.html?type=3">旅行</a> 
       <a href="/pages/radio/radioType.html?type=1">爱情</a>
      </div> 
      <div class="radio-list-group">
       <div class="radio-list">
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/89f647e50adf785a565baeccd186edc8.jpg" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/89f647e50adf785a565baeccd186edc8.jpg" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/89f647e50adf785a565baeccd186edc8.jpg" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=55d6c0c7723125dd668b456a" target="_blank"><span class="radio-img-bg"></span> <span>-<br />给你夜晚片刻安宁 ......『片刻每日晚安推荐』</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=55d6c0c7723125dd668b456a" target="_blank">七夜电台</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=550036" target="_blank">主播&nbsp;/&nbsp;pianketing</a>
          </div> 
          <div class="radio-others">
           45924209次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20150113/951d8e9ef01c0bf96b0c038bfa6783ae.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20150113/951d8e9ef01c0bf96b0c038bfa6783ae.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20150113/951d8e9ef01c0bf96b0c038bfa6783ae.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=53fef96b8ead0efb0300000b" target="_blank"><span class="radio-img-bg"></span> <span>-<br />轻轻唱给你听的...</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=53fef96b8ead0efb0300000b" target="_blank">安琪的吉他屋</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=454412" target="_blank">主播&nbsp;/&nbsp;anqiiiiiiiiii</a>
          </div> 
          <div class="radio-others">
           4822201次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20150410/e1d6e5194c0ba5323a1381653083bbe7.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20150410/e1d6e5194c0ba5323a1381653083bbe7.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20150410/e1d6e5194c0ba5323a1381653083bbe7.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=54f020579ea288f82b000012" target="_blank"><span class="radio-img-bg"></span> <span>-<br />一半孤独，一半温暖，我想伴着你，在这时间里</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=54f020579ea288f82b000012" target="_blank">阿绿酒馆</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=296663" target="_blank">主播&nbsp;/&nbsp;少女绿妖</a>
          </div> 
          <div class="radio-others">
           2054684次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20151120/a174b2d7b1607779d77303953496f5c7.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20151120/a174b2d7b1607779d77303953496f5c7.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20151120/a174b2d7b1607779d77303953496f5c7.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=54bdcd438ead0ee51f00015a" target="_blank"><span class="radio-img-bg"></span> <span>-<br />深入灵魂的交涉</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=54bdcd438ead0ee51f00015a" target="_blank">半岛玫瑰</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=521991" target="_blank">主播&nbsp;/&nbsp;半岛玫瑰</a>
          </div> 
          <div class="radio-others">
           27327039次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/d02e858975daa236c3cb82231561fe69.jpg" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/d02e858975daa236c3cb82231561fe69.jpg" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/d02e858975daa236c3cb82231561fe69.jpg" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=581ef487723125e14e8b45bf" target="_blank"><span class="radio-img-bg"></span> <span>-<br />给你片刻最新发声 ......『片刻每日新声推荐』</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=581ef487723125e14e8b45bf" target="_blank">最新发声</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=550036" target="_blank">主播&nbsp;/&nbsp;pianketing</a>
          </div> 
          <div class="radio-others">
           12376684次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20160113/c42354a58d4270fb334134676180f24c.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160113/c42354a58d4270fb334134676180f24c.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160113/c42354a58d4270fb334134676180f24c.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=5695ca1f72312503028b45c4" target="_blank"><span class="radio-img-bg"></span> <span>-<br />最好听的翻唱都在这里了 (ง •̀_•́)ง </span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=5695ca1f72312503028b45c4" target="_blank">片刻翻唱</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=550036" target="_blank">主播&nbsp;/&nbsp;pianketing</a>
          </div> 
          <div class="radio-others">
           15296242次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20160215/ae607eacfad0dd514bca6159c8293635.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160215/ae607eacfad0dd514bca6159c8293635.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160215/ae607eacfad0dd514bca6159c8293635.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=56c1af96723125f5688b458e" target="_blank"><span class="radio-img-bg"></span> <span>-<br />『世界运转的太快，让我们用音乐慢慢诉说』</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=56c1af96723125f5688b458e" target="_blank">片刻原创</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=550036" target="_blank">主播&nbsp;/&nbsp;pianketing</a>
          </div> 
          <div class="radio-others">
           10186557次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkimg.image.alimmdn.com/upload/20160322/c302647218f62926bf7a8f4ac873ea2f.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160322/c302647218f62926bf7a8f4ac873ea2f.JPG" class="lazy loaded" /> 
          <img src="http://pkimg.image.alimmdn.com/upload/20160322/c302647218f62926bf7a8f4ac873ea2f.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=569de9f5723125c2058b45e5" target="_blank"><span class="radio-img-bg"></span> <span>-<br />音乐，是最好的精神良药</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=569de9f5723125c2058b45e5" target="_blank">汶霖FM</a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=3301181" target="_blank">主播&nbsp;/&nbsp;汶霖FM</a>
          </div> 
          <div class="radio-others">
           1202466次播放
          </div>
         </div>
        </div>
        <div class="radio-cpt">
         <div class="radio-img">
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/25c9f9e1c4fc9dead57b6bbd385617e8.JPG" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/25c9f9e1c4fc9dead57b6bbd385617e8.JPG" class="lazy loaded" /> 
          <img src="http://pkicdn.image.alimmdn.com/old/newuploads/25c9f9e1c4fc9dead57b6bbd385617e8.JPG" class="lazy loaded" /> 
          <a href="/pages/radio/radioInfo.html?id=5416b2408ead0e4e4900028a" target="_blank"><span class="radio-img-bg"></span> <span>-<br />以摇滚乐为主，人生苦短，多听歌，少说话</span></a>
         </div> 
         <div class="radio-info">
          <div class="radio-title">
           <a href="/pages/radio/radioInfo.html?id=5416b2408ead0e4e4900028a" target="_blank">药物青春唱片馆 </a>
          </div> 
          <div class="radio-author">
           <a href="/pages/user/user.html?uid=102708" target="_blank">主播&nbsp;/&nbsp;夏阳的药物青春</a>
          </div> 
          <div class="radio-others">
           690088次播放
          </div>
         </div>
        </div>
       </div> 
       <div class="no-more-data" style="display: none;">
        -&nbsp;已加载全部&nbsp;-
       </div> 
       <div class="loading" style="display: none;"></div>
      </div>
     </div>
    </div>
   
    <div data-index="16" class="card-ting-cpt" style="left: 303px; top: 2193px; opacity: 1;">
    <div class="card-top-img">
     <a href="/pages/radio/tingInfo.html?tingid=5b64193b257be9e95ecf8963" target="_blank"><img src="http://hpimg.pianke.com/89a57f277d7e1bdfb169453706ef58cb20180803.jpg?imageView2/2/w/640/format/jpg" /> <span></span></a>
    </div> 
    <div class="card-item">
     <div class="card-ting-title">
      <a href="/pages/radio/tingInfo.html?tingid=5b64193b257be9e95ecf8963" target="_blank">这世界全部的漂亮，不过你的可爱模样</a>
     </div> 
     <div class="user-sign">
      <a href="./user.html?uid=4096947" target="_blank">主播&nbsp;/&nbsp;白无常白总</a>
     </div> 
     <div class="card-others">
      <span class="card-type"><a href="/pages/radio/radio.html" target="_blank">Ting</a></span> 
      <span>11.1 k次播放&nbsp;&nbsp;|&nbsp;&nbsp;评论:11&nbsp;&nbsp;|&nbsp;&nbsp;喜欢:229</span>
     </div> 
     <div class="card-user">
      <div class="card-user-info">
       <a href="/pages/user/user.html?uid=4096947" target="_blank"><img src="http://tva3.sinaimg.cn/crop.0.0.500.500.50/006qhQumjw8f213ygfh47j30dw0dwwfi.jpg" width="" />白无常白总</a>
      </div> 
      <div class="card-likes likes-cpt"></div>
     </div>
    </div>
   </div>



   <div class="back-top hidden"></div> 
</div>
@endsection