@extends('admin.base')
@section('title','新增图片')
@section('head')
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="Hui-article-box" style="top:80px">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/dian/update')}}" enctype="multipart/form-data">
	<input type="hidden" name="id" value="{{$list['id']}}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>店名</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$list['name']}}" placeholder="" id="" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$list['adress']}}" placeholder="" id="" name="adress">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>营业时间</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$list['time']}}" placeholder="" id="" name="time">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>电话</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$list['tel']}}" placeholder="" id="" name="tel">
			</div>
		</div>

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
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 修改</button>

				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/dian/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			</div>
		</div>
		{{csrf_field()}}
	</form>
	
</div>
</div>
		<script>
		function dong(){
			//获取被选中的option标签
 		var vs = $('select option:selected').val();
 			$.get("city",{id:vs},function(data){
 				for (var i = 0; i < data.length; i++) {
				cc = data[i]['name'];
				gg = data[i]['id'];
				// alert(cc);
				aa = $("<option>");
				aa.html(cc);
				aa.val(gg);
				$('#city').append(aa);
				}
 			})
		}
	

		</script>

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 


@endsection