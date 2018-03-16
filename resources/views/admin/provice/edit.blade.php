@extends('admin.base')
@section('title','后台主页')
@section('content')
<div class="Hui-article-box">
	<form class="form form-horizontal" id="form-article-add" method="post" action="{{asset('/admin/provice/update')}}" enctype="multipart/form-data">
		<input type="hidden" value="{{$arr['id']}}" name="id">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>地址名：</label>
			<div class="formControls col-xs-8 col-sm-5">
				<input type="text" class="input-text" value="{{$arr['name']}}" placeholder="" id="" name="name">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属类别：</label>
			<div class="formControls col-xs-8 col-sm-5">
					<select name="pid" id="">
                        @if($arr->getOriginal('pid')==0)
                        	<option value="{{$arr->getOriginal('pid')}}">{{$arr['pid']}}</option>
						@else
                        <option value="{{$list['id']}}">{{$list['pid']}}</option>
                       	@endif
                      </select>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<button onClick="article_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i>修改</button>

				<button onClick="layer_close();" class="btn btn-default radius" type="reset"><a href="{{asset('admin/provice/index')}}">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></button>
			</div>
		</div>
	@if(Session::has('message'))		
	<div class="row cl" style="margin-left:20%">
				        <ul style="color:red;">
				       
				            <li>{{Session::get('message')}}</li>

				        </ul>
	</div>
	@endif
	{{csrf_field()}}
	</form>

</div>
</div>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/admin/lib/webuploader/0.1.5/webuploader.min.js"></script> 


@endsection