@extends('admin/layout/index')

@section('content')
<div >
	<form  action="/admin/Conf/title_update" method="post" class="form-group" style="width:500px;" >
		{{ csrf_field() }}
		<label for="pillInput"><font style="vertical-align: inherit; "><font style="vertical-align: inherit;">网站标题</font></font></label>
		<input type="text" class="form-control input-pill" value="{{ $title1 }}" id="pillInput" name="title"  placeholder="网站标题">
			<input type="submit" class="btn btn btn-info btn-round form-control" style="margin-top:10px;" value="修改">
	</form>
		
	<div class="form-group">
		<label for="logo">
			<font style="vertical-align: inherit; ">
			<font style="vertical-align: inherit;">网站Logo</font>
			</font>
		</label>
		<label for="logo">
			<img src="/uploads/{{ $path }}" title="点击图片更换Logo" width="80" height="37">
		</label>
		<form style="display: none;" id="logo_file" action="upload_file.php" method="post" ectype="multipart/form-data">
			{{ csrf_field() }}
			更换头像：<input type="file" name="logo" value="" id="logo">	
		</form>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		$('#logo').change(function(){
		 	$.ajax({
				type:'POST',
				url:'/admin/Conf/Logo_update',
				data:{'data':new FormData($('#logo_file')[0]),'_token':$('#logo_file')[1]},
				processData:false,
				contentType:false,
				success:function(obj){
					if(obj = 111){
						alert(1);
					}else{
						alert('头像更换失败');
					}
				},
				dataType:'json',
			})
		});
	});
</script>
@endsection
