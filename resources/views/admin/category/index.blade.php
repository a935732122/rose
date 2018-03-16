@extends('admin.base')
@section('title','后台主页')
@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 导航管理 <span class="c-gray en">&gt;</span> 导航列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<form class="form form-horizontal"  method="get" action="{{asset('admin/category/index')}}" >
				<input type="text" name="name" id="" placeholder="类别名称" style="width:250px" class="input-text" value="{{$search['name'] or ''}}">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜类别名</button>
				{{csrf_field()}}

				</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l"> <a class="btn btn-primary radius" href="{{asset('admin/category/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> 
					@if(Session::has('message'))
				<span style="padding-left:36%;color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
				@endif
				<span class="r">共有数据：<strong>{{$num}}</strong> 条</span> 
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="80">ID</th>
							<th width="419">类名</th>
							<th width="419">所属类别</th>
							<th width="419">缩略图</th>
							<th width="419">链接</th>
							<th width="419">状态</th>
							<th width="419">操作</th>
						</tr>
					</thead>

					<tbody>

						@foreach($list as $k=>$v)
						<tr class="text-c">
								<td>{{$v->id}}</td>
								<td>{{$v['name']}}</td>
								<td>
										{{$v['pid']}}
								</td>
								<td><img src="{{$v['image']}}" alt="" style="width:200px"></td>

								<td class="td-status">{{$v['link']}}</td>
								<td class="td-status">{!!$v['status']!!}</td>
								<td class="td-manage">
									@if($v->getOriginal('pid')==0)
									<a style="text-decoration:none" onClick="picture_stops(this,'{{$v['id']}}')" href="javascript:;" title="禁用">
									<i class="Hui-iconfont">&#xe6de;</i></a> 
									@elseif($v->getOriginal('status')==1)
									<a style="text-decoration:none" onClick="picture_stop(this,'{{$v['id']}}')" href="javascript:;" title="禁用">
									<i class="Hui-iconfont">&#xe6de;</i></a> 
									@elseif($v->getOriginal('status')==2)
									<a style="text-decoration:none" onClick="picture_start(this,'{{$v['id']}}')" href="javascript:;" title="启用">
									<i class="Hui-iconfont">&#xe603;</i></a> 
									@endif
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/category/edit')}}/{{$v['id']}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
									@if($v->getOriginal('pid')==0)
									<a style="text-decoration:none" class="ml-5" onClick="picture_dels(this,'{{$v['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
									@else
									<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$v['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
									@endif
									
								</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $list->appends(['name'=>$search['name']])->render() !!}



			</div>
		</article>
	</div>
</section>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏启用
	  {"orderable":false,"aTargets":[0,8]}// 制定列不参与排序
	]
});
/*图片-添加*/
function picture_add(title,url){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}


/*图片-下架*/
function picture_stop(obj,id){
	layer.confirm('确认要禁用吗？',function(index){
		window.location.href="{{asset('/admin/category/sta')}}?id="+id;
		layer.msg('已禁用!',{icon: 5,time:1000});
		//此处请求后台程序，下方是成功后的前台处理……
	});
}
function picture_stops(obj,id){
	layer.confirm('确认要禁用吗？',function(index){
		window.location.href="{{asset('/admin/category/sta')}}?id="+id;
		layer.msg('禁用失败!',{icon: 5,time:1000});
		//此处请求后台程序，下方是成功后的前台处理……
	});
}

/*图片-发布*/
function picture_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		window.location.href="{{asset('/admin/category/sta')}}?id="+id;
		layer.msg('已启用!',{icon: 6,time:1000});

		
		//此处请求后台程序，下方是成功后的前台处理……
	});
}


/*图片-申请上线*/
function picture_shenqing(obj,id){
	$(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
	$(obj).parents("tr").find(".td-manage").html("");
	layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}
/*图片-编辑*/
function picture_edit(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href="{{asset('/admin/category/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……

		// $(obj).parents("tr").remove();
		// layer.alert("{{Session::get('message')}}!",{time:1000});
	});
}
function picture_dels(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		// window.location.href="{{asset('/admin/category/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……
		// $(obj).parents("tr").remove();
		layer.msg('顶级类别不能删除!',{icon:5,time:1000});
	});
}
</script>

@endsection
