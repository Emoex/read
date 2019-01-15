@extends('admin/layout/index')

@section('content')
<a href="/admin/Conf/Slide/create" class="btn btn-info" id="tianjia">添加轮播图</a><br><br>
	<div class="card">
		<div class="card-body" >
			<table class="table table-hover" >
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
						<td width="500px"><img src="{{ $v->content }}" style="width:80%"></td>
						<td>
							<a href="/admin/Conf/Slide/{{ $v->id }}/edit" class="btn btn-warning">修改</a>
							<form action="/admin/Conf/Slide/{{ $v->id }}" method="post" style="display:inline-block;">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<input type="submit" value="删除" class="btn btn-danger">
							</form>
						</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">

	</script>
@endsection