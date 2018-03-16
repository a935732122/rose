@extends('admin.base')
@section('title','新增图片')
@section('head')
<link href="/admin/lib/webuploader/0.1.5/webuploader.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="Hui-article-box" style="top:80px">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/provice/save')}}" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址名：</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="" placeholder="" id="" name="name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属地址：</label>
			<div class="formControls col-xs-8 col-sm-5">
					<select name="pid" id="">
						<option value="0">省级城市</option>
                        @foreach($list as $vo)
                        <option value="{{$vo['id']}}">{{$vo['name']}}</option>
                       @endforeach
                      </select>
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
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>

				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/provice/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			</div>
		</div>
		{{csrf_field()}}
	</form>
	
</div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 


@endsection