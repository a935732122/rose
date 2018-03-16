@extends('admin.base')
@section('title','后台主页')
@section('content')
<div class="Hui-article-box">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/pdo/img')}}" enctype="multipart/form-data">
		<div class="row cl">
			<label class="form-label col-xs-8 col-sm-4"><span class="c-red">*</span><h4>你正在向{{$list}}商品添加图片</h4></label>
		</div>
		<input type="hidden" name="pdo_id" value="{{$id}}">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">图片名</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="" placeholder="" id="" name="title">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">类别</label>
			<div class="formControls col-xs-8 col-sm-5">
				<select name="status" id="">
						<option value="1">缩略图</option>
						<option value="2">大图</option>
              	</select>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文件路径：</label>
			<div class="formControls col-xs-8 col-sm-5">
				<div class="uploader-thum-container">
					<span class="btn-upload form-group" style="margin-left: 0;">
					 <input class="input-text upload-url radius" type="text" name="uploadfile-1" id="uploadfile-1" readonly>
					 <img src="" alt="" name="uploadfile-1" class="upload-url" id="uploadfile-1">
					  <a href="javascript:void();" class="btn btn-primary radius" style="margin-left: 20px;"><i class="iconfont">&#xf0020;</i> 浏览文件</a>
					  <input type="file" multiple name="image" class="input-file" id="doc" onchange="javascript:setImagePreview();">
					</span>
				</div>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图</label>
			<div class="formControls col-xs-8 col-sm-5">
				<div id="localImag" style="height:200px">
		　　　　　　<img id="preview" style="display: block;">
		　　　　</div>
			</div>
		</div>
		
		
		
		
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 添加</button>
				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/pdo/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			
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