@extends('admin/layout/index')

@section('content')
	<div class="card">
		<div class="card-body">
			<table class="table table-hover" style="text-align: center">
				<thead>
					<tr>
						<th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">ID</font></font></th>
						<th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">分类类别</font></font></th>
						<th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发布者</font></font></th>
						<th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">发布时间</font></font></th>
						<th scope="col"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">操作</font></font></th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $k=>$v)
					<tr>
						<td>{{ $v->id }}</td>
						<td>{{ $v->id }}</td>
						<td>{{ $v->uid }}</td>
						<td>{{ $v->created_at }}</td>
						<td>
							<a href="/admin/timeline/{{ $v->id }}" class="badge badge-info" >信息</a>	
							<a href="javascript:;" class="badge badge-danger" onclick="delete1({{ $v->id }},this)">删除</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<div class="hidden">
			{{ csrf_field() }}
		</div>

		<script>
			function delete1(id,obj){
				$.post('/admin/timeline/'+id,{'_method':'DELETE','_token':$('.hidden input[name=_token]').val()},function(msg){
						if(msg == 'success'){
							$(obj).parent().parent().remove();
						}else{
							alert('删除失败');
						}
				},'html');
			}
		</script>
	</div>
@endsection