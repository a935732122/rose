@extends('admin.base')
@section('title','后台主页')
@section('content')

				   
	<div class="Hui-article-box">
		<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/user/srole')}}" enctype="multipart/form-data">
		 	{{ csrf_field() }}
			<div class="row cl">
				<label class="form-label col-xs-5 col-sm-3"><span class="c-red">*</span>你正在给用户{{$user['name']}}添加角色</label>
				
			</div>
			
			<div class="row cl">
			
				<div class="formControls col-xs-8 col-sm-5">
					<input type="hidden" class="input-text" value="{{ $user['id'] }}" placeholder="" id="" name="id">

				</div>
			</div>
			
			<div class="row cl">
					      <label class="form-label col-xs-4 col-sm-2">角色：</label>

					      @foreach($roles as $role)
					      	
					        <input type="checkbox" value="{{ $role['id'] }}" name="role[]"
					        	 @if(!empty($ids))
									@if(in_array($role['id'],$ids))
									checked
									@endif
								@endif
					        > {{ $role['display_name'] or $role['name'] }}
					     
					      @endforeach
					    </div>
			
			
			<div class="row cl">
				<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
					<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>
					<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/user/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
					
				</div>
			</div>
			{{csrf_field()}}
		</form>	 	
				   
	
				
				 @if (count($errors) > 0)
				    <div class="alert alert-danger">
				        <ul style="color:red;">
				        @foreach ($errors->all() as $error)
				            <li>{{ $error }}</li>
				        @endforeach
				        </ul>
				    </div>
				@endif

	
	<!-- Row end -->
</div>


		
@endsection