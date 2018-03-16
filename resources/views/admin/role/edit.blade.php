@extends('admin.base')
@section('title','后台主页')
@section('content')
<div class="Hui-article-box">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/role/update')}}" enctype="multipart/form-data">

	<div class="row cl">
		<div class="formControls col-xs-8 col-sm-5">
				<input type="hidden" class="input-text" value="{{$rose['id']}}" placeholder="" id="" name="id">
			</div>
	</div>
		<div class="row cl">
			
			<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>你正在给{{$rose['name']}}添加权限</label>
			
		</div>
		<div class="row cl">
				      
				     
						<label class="form-label col-xs-4 col-sm-2">权限：</label>
						<div class="formControls col-xs-8 col-sm-5">
					      @foreach($permissions as $permission)
					      
					        <input type="checkbox" value="{{ $permission['id'] }}" name="permission[]" 
					        	@if(!empty($ids))
									@if(in_array($permission['id'],$ids))
									checked
									@endif
								@endif
					        > {{ $permission['display_name'] or $permission['name'] }}
					     
					      @endforeach
		</div>
		</div>
				
		
		
		
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 修改</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/role/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
				
			</div>
		</div>
		{{csrf_field()}}
	</form>
	@if (count($errors) > 0)
				    <div class="row cl" style="margin-left:20%">
				        <ul style="color:red;">
				        @foreach ($errors->all() as $error)
				            <li>{{ $error }}</li>
				        @endforeach
				        </ul>
				    </div>
	@endif
</div>
</div>
@endsection('content')