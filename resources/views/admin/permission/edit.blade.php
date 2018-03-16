@extends('admin.base')
@section('title','后台主页')
@section('content')
<div class="Hui-article-box">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/permission/update')}}" enctype="multipart/form-data">
		
		<div class="row cl">
		
			<div class="formControls col-xs-8 col-sm-5">
				<input type="hidden" class="input-text" value="{{$permissions['id']}}" placeholder="" id="" name="id">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>权限</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$permissions['name']}}" placeholder="" id="" name="name">
			</div>
		</div>
		
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">权限名</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$permissions['display_name']}}" placeholder="" id="" name="display_name">
			</div>
		</div>
		
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/permission/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			</div>
		</div>
	
		{{csrf_field()}}
	
	</form>
	@if(Session::has('info'))
		<span class="text-c" style="color: red"><strong>
		        {{Session::get('info')}}
		 </strong> </span>   
	@endif
</div>
</div>
@endsection('content')