@extends('admin.base')
@section('title','后台主页')
@section('content')
<div class="Hui-article-box">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/cate_image/update')}}" enctype="multipart/form-data">
		<input type="hidden" value="{{$list['id']}}" name="id">
		<div class="row cl">
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文件路径：</label>
			<div class="formControls col-xs-8 col-sm-5">
				<div class="uploader-thum-container">
					<span class="btn-upload form-group" style="margin-left: 0;">
					 <input class="input-text upload-url radius" type="text" name="uploadfile-1" id="uploadfile-1" value="{{$list['image']}}" readonly>
					  <a href="javascript:void();" class="btn btn-primary radius" style="margin-left: 20px;"><i class="iconfont">&#xf0020;</i> 浏览文件</a>
					  <input type="file" multiple name="image" class="input-file" id="doc" onchange="javascript:setImagePreview();">
					</span>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图</label>
			<div class="formControls col-xs-8 col-sm-5">
				<div id="localImag">
		　　　　　　<img id="preview"  width="150" style="display: block;" src="{{$list['image']}}">
		　　　　</div>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>修改</button>

				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/cate_image/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			</div>
		</div>
		{{csrf_field()}}
	</form>
</div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 


@endsection