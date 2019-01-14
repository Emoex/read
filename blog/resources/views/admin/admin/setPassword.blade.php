@extends('admin/layout/index')
@section('content')
<div class="card-body">
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                                       <form action="/admin/setPassword/{{ $admin->id }}" method="post">
                                       {{ csrf_field() }}
										<div class="form-group">
											<label for="oldPwd">旧密码:</label>
											<input type="password" class="form-control" id="oldPwd" name="oldPwd" value="" placeholder="请输入旧密码">
										</div>
										<div class="form-group">
											<label for="newPwd">新密码:</label>
											<input type="password" class="form-control" id="newPwd" name="newPwd" value="" placeholder="请输入新密码">
										</div>
										<div class="form-group">
											<label for="reNewPwd">再次输入新密码:</label>
											<input type="password" class="form-control" id="reNewPwd" name="reNewPwd" value="" placeholder="再次输入新密码">
										</div>
										<input type="submit" value="修改" class="btn btn-success">
										</form>
@endsection