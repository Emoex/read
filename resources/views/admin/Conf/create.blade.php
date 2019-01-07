@extends('admin/layout/index')

@section('content')
	<div class="form-group" style="width:200px;">
		<label for="pillSelect"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">配置选择</font></font></label>
		<select class="form-control input-pill" id="pillSelect">
			<option>
				<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;">请选择</font>
				</font>
			</option>
			<option>
				<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;">标题管理</font>
				</font>
			</option>
			<option>
				<font style="vertical-align: inherit;">
					<font style="vertical-align: inherit;">login管理</font>
				</font>
			</option>
		</select>
	</div>
@endsection