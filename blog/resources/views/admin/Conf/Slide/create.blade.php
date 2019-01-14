@extends('admin/layout/index')

@section('content')
	<form action="/admin/Conf/Slide" method="post" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="file" name="content">
		<input type="submit" value="提交" class="btn btn-info">
	</form>
@endsection