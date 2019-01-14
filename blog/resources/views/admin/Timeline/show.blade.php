@extends('admin/layout/index')

@section('content')
	<div class="card" style="width:700px;padding:30px 46px;">
		<div>
			<div style="width:100%; height:40px;margin-bottom:40px;">
				<div style="float:left;">
					<a href="#">
						<img src="{{ $data->User->face}}" style="width:40px;height:40px;"></img>
					</a>
					<a href="#">{{ $data->User->nickname }}</a>
				</div>
				<div style="float:right;height:40px;line-height:40px;">
					<font style="vertical-align: inherit;">
						{{ $data->created_at }}
					</font>	
				</div>
			</div>

			@if($data->image)
				<div style="width:100%;">
					<img width="100%" src="{{ $data->image }}"></img>
				</div>
				<div style="padding-top:40px;padding-bottom:20px;">
					<font style="vertical-align: inherit;">{{ $data->content }}</font>
				</div>
			@else
				<div style="padding-bottom:20px;">
					<font style="vertical-align: inherit;">{{ $data->content }}</font>
				</div>
			@endif
			<div>
				<div style="width:35px;height:30px;float:left;margin-right:8px;">
					<img src="/uploads/images/likeh.png" style="width:35px;height:30px;">
				</div>
				<div style="float:left;height:30px;line-height:30px;">
					<font>{{ $data->like }}</font>
				</div>
				<div style="float:right;height:30px;line-height:30px;">
					<font size="5px;">评论：</font><font size="3px;">{{ $data->comment()->count() }}</font>
				</div>
			</div>
		</div>
	</div>
@endsection