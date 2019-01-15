@extends('admin/layout/index')

@section('content')
	<div class="card">
		<form action="/admin/Conf/Slide/{{$data->id}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field('PUT') }}
			<img src="{{ $data['content'] }}"><br><br>
			<input type="file" name="content"><br><br>
			<input class="btn btn-warning" type="submit" value="修改">
		<form>
	<div>
@endsection