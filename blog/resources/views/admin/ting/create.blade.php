@extends('admin/layout/index')
@section('content')
	@if(count($errors) >0)
		<div calss='alert alert-danger'>
			<ul>
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

 <form action="/admin/ting" method="post" enctype="multipart/form-data">

   {{ csrf_field() }}
   <div class="form-group">
		<label for="uid">用户:</label>
		<select class="form-control" id="uid" name="uid">
				@foreach($user as $k=>$v)
				   <option value="{{ $v->id }}">{{ $v->uname }}</option>
				@endforeach
	   </select>
	</div>
	<div class="form-group">
		<label for="title">电台标题:</label>
		<input type="text" class="form-control" id="title" value="{{ old('uname') }}" name="title" placeholder="电台标题">
	</div>
	<div class="form-group">
			<label for="tingcate">电台类别:</label>
			<select class="form-control" id="tingcate" name="tingcate">
				@foreach($tingcate as $k=>$v)
				<option value="{{ $v->name }}">{{ $v->name }}</option>
				@endforeach
			</select>
	</div>
	<div class='form-group'>
		  <label for="tingtext">添加文章:</label>
	          <select class="form-control" id="tingtext" name="aid">
				@foreach($article as $k=>$v)
				<option value="{{ $v->id }}">{{ $v->title }}</option>
				@endforeach
			</select>
	</div>
	<div class="form-group">
		<label for="img">封面:</label>
		<div><input type="file" name="img"></div>
	</div>
	<div class="form-group">
		<label for="music">音乐:</label>
		<div><input type="file" name="music" ></div>
	</div>
	<input type="submit" value="添加" class="btn btn-success">
	</form>

@endsection