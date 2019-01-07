@extends('admin/layout/index')
@section('content')
<div class="card-body">
<table class="table table-hover">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">举报人</th>
			<th scope="col">举报内容</th>
			<th scope="col">板块</th>
			<th scope="col">状态</th>
			<th scope="col">操作</th>
		</tr>
	</thead>
	<tbody>
	@foreach($reports as $k=>$v)
		<tr>
			<td>{{ $v->id }}</td>
			<td>{{ $v->User->uname }}</td>
			@if($v->table != '文章')
			<td>{{ $v->content }}</td>
			@else
			<td style="color:#bbb">请点击详情查看</td>
			@endif
			<td>{{ $v->table }}</td>
			<td id="status">
				@if($v->status == 1)未处理
				@elseif($v->status == 2)同意
				@elseif($v->status == 3)拒绝
				@endif
			</td>
			<td id="caozuo">
			    @if($v->table == '文章')
			    <a href="javascript:;" onclick="showContent({{ $v->idid }})" class="btn btn-default">详情</a>
			    @endif
			    <a href="javascript:;" class="btn btn-success" display="block" onclick="edit({{ $v->id }},1,this)">同意</a>
			    <a href="javascript:;" class="btn btn-info"    display="block" onclick="edit({{ $v->id }},2,this)">拒绝</a>
			    <a href="javascript:;" onclick="destroy({{ $v->id }},this)" class="btn btn-warning">删除</a>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>

<!-- 模态框 -->
<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
	        ...
	      </div>
	    </div>
	  </div>
</div>

<div id="paging">
			{{ $reports->links() }}
</div>	

</div>
<div class="hidden">
	{{ csrf_field() }}
</div>
<script>
        $(function(){
				 destroy = function(id,obj){
					$.post('/admin/report/'+id,{'_token':$('.hidden input').val(),'_method':'DELETE'},function(msg){
						if(msg == 'success'){
							$(obj).parent().parent().remove();
						}else{
							alert('删除失败');
						}
					},'html');
				}

          	   edit =  function(id,temp,obj){
          	   	  $.post('/admin/report/'+id,{'temp':temp,'_token':$('.hidden input').val(),'_method':'PUT'},function(msg){
          	   	  	if(msg == 'agree'){
          	   	  	  $(obj).parent().prev().html('同意');	
          	   	  	}else{
          	   	  	  $(obj).parent().prev().html('不同意');
          	   	  	}
          	   	  },'html');
          	   }

			   showContent = function(id){
				var url = '/admin/article/'+id;
				$.get(url,function(data){
					if(data.msg != 'error'){
						console.log(data);
						// 修改模态框的值 并且显示
						$('#myModal h4').eq(0).html(data.title);
						$('#myModal .modal-body').html(data.content);
						// 显示模态框
						 $('#myModal').modal('show')
					}
				},'json');
			};

        })

</script>

<style type="text/css">
#paging{
	margin-left:40%;
}
#paging .active{
		background: blue;
	}
#paging .active span{
	color:#fff;
}
#paging li{
	width:30px;
	height:30px;
	border:1px solid #ccc;
	border-radius: 100%;
	text-align: center;
	line-height: 30px;
	margin:13px 6px;
}
#paging li:hover{
	background: #eee;
	color:blue;
}
#paging .disabled{
	background: #eee;
}

</style>
@endsection