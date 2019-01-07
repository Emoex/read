@extends('admin/layout/index')

@section('content')
	<div class="card">
		<div class="card-body">
			<table class="table table-hover" center>
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">图片</th>
						<th scope="col">操作</th>
					</tr>
				</thead>
				<tbody>
				@foreach($data as $k=>$v)
					<tr>
						<td>{{ $v->id }}</td>
						<td><img src="/uploads/{{ $v->content }}"></td>
						<td>
							<a href="/admin/Conf/Slide/{{ $v->id }}/edit" class="btn btn-warning">修改</a>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
@endsection