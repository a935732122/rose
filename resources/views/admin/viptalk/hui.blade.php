@extends('admin.base')
@section('title','评论回复')
@section('head')
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="Hui-article-box" style="top:80px">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/viptalk/edit')}}" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>您正在回复{{$list['vid']}}的评论</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$list['text']}}" placeholder="" id="" readonly="readonly">
				
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span></label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="" placeholder="" id="" name="hui">
				<input type="hidden" class="input-text" value="{{$list['id']}}" name="talk_id">
			</div>
		</div>
		<div class="row cl">
		
		
		@if (count($errors) > 0)
			<div class="row cl">
				<label class="form-label col-xs-4 col-sm-2">错误信息：</label>
				<div class="formControls col-xs-8 col-sm-5">
					<ul style="color:red;">
					        @foreach ($errors->all() as $error)
					            <li>{{ $error }}</li>
					        @endforeach
					        </ul>
				</div>
			</div>	    
		@endif
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="return checkEmail()" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 回复</button>

				<button onClick="layer_close();" class="btn btn-default radius" type="reset">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
		{{csrf_field()}}
	</form>
	@if(Session::has('message'))
										<div class="alert alert-danger">
									        {{Session::get('message')}}
									    </div>
									@endif
</div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script><script type="text/javascript">
//判断用户输入的电子邮箱格式是否正确
function checkEmail(){
　　var myforms=document.forms;
　　var myemail=myforms[0].email.value;
　　var myReg=/^[a-zA-Z0-9_-]+@([a-zA-Z0-9]+\.)+(com|cn|net|org)$/;

　　if(myReg.test(myemail)){
　　　　return true;
　　}else{
　　　　myspan.innerText="邮箱格式不对!";
　　　　return false;
}
}

</script>


@endsection