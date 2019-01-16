@extends('admin/layout/index')

@section('content')
	<!-- 显示错误信息 -->
	@if (count($errors) > 0)
	    <div class="alert alert-danger">
	        <ul>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
	@endif

	<div style="width:700px;">
		<form action="/admin/timeline" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
		  	<textarea class="form-control" id="textarea" rows="5" maxlength=140 name="content" placeholder="这一刻，想说什么" style="min-height:150px;max-height:150px;resize: none;"></textarea>
			<div style="height:50px;">
			  	<div style="border-radius: 50px; border:2px #23CCEF solid; width:96px; margin-top:15px;margin-left:50px;float:left;">
				  <span id="gongkai" class="badge badge-info" style="cursor:pointer;">公开</span>
				  <span id="mimi" class="badge" style="cursor:pointer;">秘密</span>
				  <input type="radio" id="public" name="public" value="1" checked>
			  	</div>
				<div style="margin-top:15px;margin-right:50px;float:right">
					<span id="zishu">0</span><span>/140字<span>
				</div>  	
		  	</div>
		  	<div>
				  	<select class="form-control" name="cid" id="disabledSelect">
				  			<option value=" ">添加碎片</option>
				  		@foreach( $cate as $k=>$v)
							<option value="{{ $v->id }}">{{ $v->name }}</option>
						@endforeach
					</select>
			</div>
			<div class="form-group" style="float:left;">
					<label for="profile" title="点击选择图片" style="cursor:pointer;"><i class="la la-image"  style="font-size:20px;color:#1D62F0;"></i><lobel>
					<label for="profile" title="点击选择图片" style="cursor:pointer;"><font size="4px" color="#1D62F0">选择一张喜欢的图片</font><lobel>
					<input type="file" name="profile" id="profile" style="display: none;">
			</div>
			<img  src=" " id="img" style="width:143px;height:143px;margin-top:20px;float:left;display:none;">
			</img>
			<input id="fabsp" class="btn btn-primary btn-round" type="submit" value="发布碎片" style="margin-top:17px;float:right;">
		</form>		
	</div>
		<script type="text/javascript">
			$('#gongkai').click(function(){
				$('#mimi').attr('class','badge');
				$(this).attr('class','badge').addClass('badge-info');
				$('textarea').attr('placeholder','这一刻，想说什么');
				$('#fabsp').val('发布碎片');
				$('#disabledSelect').unwrap();
				$('#public').val(1);
			})
			$('#mimi').click(function(){
				$(this).addClass("badge-info");
				$('#gongkai').attr('class','badge');
				$('textarea').attr('placeholder','以匿名的方式倾诉');
				$('#fabsp').val('匿名发布');
				$('#disabledSelect').wrap('<fieldset disabled></fieldset>');
				$('#public').val(2);
			})
			$('#textarea').on('input',function(){
				$('#zishu').text($(this).val().length);
			});
			$('#profile').change(function(){
				var objUrl = getObjectURL(this.files[0]);
			    if (objUrl) 
			    {
			      $('#img').css('display','block').attr('src',objUrl);
			    }
			});
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
		</script>
	</div>
@endsection