@extends('admin.base')
@section('title','后台主页')

@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 轮播管理 <span class="c-gray en">&gt;</span> 首页轮播列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
			<form class="form form-horizontal"  method="get" action="{{asset('admin/banner/index')}}" >
				<input type="text" name="title" id="" placeholder=" 图片名称" style="width:250px" class="input-text" value="{{$search['title'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜图片</button>
				{{csrf_field()}}

			</form>
			</div>
		
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l"> <a class="btn btn-primary radius"  href="{{asset('admin/banner/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加图片</a></span> 
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
							<th width="419">标题</th>
							<th width="419">缩略图</th>
							<th width="419">创建时间</th>
							<th width="419">修改时间</th>
							<th width="419">状态</th>
							<th width="419">操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $k=>$v)
						<tr class="text-c">
								<td>{{$v->id}}</td>
								<td>{{$v['title']}}</td>
								
								<td><img src="{{$v['image']}}" alt="" style="width:200px;"></td>
								<td>{{$v['created_at']}}</td>
								<td>{{$v['updated_at']}}</td>
								<td class="td-status">{!!$v['status']!!}</td>
								<td class="td-manage">
									@if($v->getOriginal('status')==1)
									<a style="text-decoration:none" onClick="picture_stop(this,'{{$v['id']}}')" href="javascript:;" title="禁用">
									<i class="Hui-iconfont">&#xe6de;</i></a> 
									@elseif($v->getOriginal('status')==2)
									<a style="text-decoration:none" onClick="picture_start(this,'{{$v['id']}}')" href="javascript:;" title="启用">
									<i class="Hui-iconfont">&#xe603;</i></a> 
									@endif
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/banner/edit')}}/{{$v['id']}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
									<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$v['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
								</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $list->appends(['title'=>$search['title']])->render() !!}
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
/*图片-查看*/
function picture_show(title,url,id){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*图片-审核*/

/*图片-禁用*/
function picture_stop(obj,id){
	layer.confirm('确认要禁用吗？',function(index){
		window.location.href="{{asset('/admin/banner/sta')}}?id="+id;
		layer.msg('已禁用!',{icon: 5,time:1000});

		
		
		//此处请求后台程序，下方是成功后的前台处理……
	});
}

/*图片-启用*/
function picture_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		window.location.href="{{asset('/admin/banner/sta')}}?id="+id;
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
		window.location.href="{{asset('/admin/banner/del')}}?id="+id;
		//此处请求后台程序，下方是成功后的前台处理……

		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}

</script>

@endsection
