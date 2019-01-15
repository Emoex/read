@extends('admin/layout/index')

@section('content')
<div >
	<form @if( $WZ_title ) action="/admin/Conf/title_update" @else action="/admin/Conf/title_store" @endif method="post" class="form-group" style="width:500px;" >
		{{ csrf_field() }}
		<label for="pillInput"><font style="vertical-align: inherit; "><font style="vertical-align: inherit;">网站标题</font></font></label>
		<input type="text" class="form-control input-pill" @if( $WZ_title ) value="{{ $WZ_title
		->content }}" @else value="" @endif  id="pillInput" name="title"  placeholder="网站标题">
			<input type="submit" @if( $WZ_title ) class="btn btn btn-warning btn-round form-control" value="修改" @else class="btn btn-info btn-round form-control" value="添加"@endif style="margin-top:10px;">
	</form>
		
	<div class="form-group">
		<label for="logo">
			<font style="vertical-align: inherit; ">
			<font style="vertical-align: inherit;">网站Logo</font>
			</font>
		</label>
		@if( $logo )
			<label for="logo">
				<img src="{{ $logo->content }}" id="new_logo" title="点击图片更换Logo" width="80" height="37">
			</label>
			<form style="display: none;" id="logo_file" method="post" ectype="multipart/form-data">
				{{ csrf_field() }}
				更换logo：<input type="file" name="logo" value="" id="logo">	
			</form>
		@else
			<form method="post" action="/admin/Conf/Logo_store" enctype="multipart/form-data">
				{{ csrf_field() }}
				添加网站Logo：<input type="file" name="logo" value="">
				<input type="submit" value="提交" class="btn btn btn-info btn-round">
			</form>
		@endif
		
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#logo').change(function(){
			var logo = new FormData($('#logo_file')[0]);
			$.ajaxSetup({
	          headers: { 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
	        })
		 	$.ajax({
				type:'POST',
				url:'/admin/Conf/Logo_update',
				data:logo,
				processData:false,
				contentType:false,
				success:function(msg){
					if( msg	!== 'error'){
						$('#new_logo').attr('src','/uploads/'+msg);
					}else{
						alert('Logo更换失败');
					}
				},
				dataType:'html',
			})
		});
	});
</script>
@endsection
