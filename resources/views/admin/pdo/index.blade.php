@extends('admin.base')
@section('title','后台主页')

@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 商品列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
			<form class="form form-horizontal"  method="get" action="{{asset('admin/pdo/index')}}" >
				<input type="text" name="name" id="" placeholder=" 商品名称" style="width:250px" class="input-text" value="{{$search['name'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜商品</button>
				{{csrf_field()}}

			</form>
			</div>
		
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l"> <a class="btn btn-primary radius"  href="{{asset('admin/pdo/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加商品</a></span> 
				@if(Session::has('message'))
				<span style="padding-left:36%;color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
				@endif
				<span class="r">共有数据：<strong>{{$num}}</strong> 条</span> 
			</div>
			
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th>商品ID</th>
							<th>商品名字</th>
							<th>商品价格</th>
							<th>商品类型 </th>
							<th>商品图片 </th>
							<th>创建时间</th>
							<th>修改时间</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $k=>$v)
						<tr class="text-c">
								<td>{{$v->id}}</td>
								<!-- <td>{{$v['name']}}</td> -->
								<td>
								<a  onclick="member_show('{{$v['name']}}','{{asset('/admin/pdo/ulist')}}','{{$v['id']}}','500','400')">{{$v['name']}}</a>
							</td>
								<td>{{$v['price']}}</td>
								<td>{{$v->pdo_type->type}}</td>
								<td><img src="{{$v['image']}}" alt="" style="width:200px"></td>
								<td>{{$v['created_at']}}</td>
								<td>{{$v['updated_at']}}</td>
								<td class="td-status">{!!$v['status']!!}</td>
								<td class="td-manage">
									@if($v->getOriginal('status')==1)
									<a style="text-decoration:none" onClick="picture_stop(this,'{{$v['id']}}')" href="javascript:;" title="下架">
									<i class="Hui-iconfont">&#xe6de;</i></a> 
									@elseif($v->getOriginal('status')==2)
									<a style="text-decoration:none" onClick="picture_start(this,'{{$v['id']}}')" href="javascript:;" title="发布">
									<i class="Hui-iconfont">&#xe603;</i></a> 
									@endif
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/pdo/param')}}/{{$v['type_id']}}/{{$v['id']}}" title="添加参数"><i class="Hui-iconfont">&#xe63c;</i></a>
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/pdo/edit')}}/{{$v['id']}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/pdo/ima')}}/{{$v['id']}}" title="添加图片"><i class="Hui-iconfont">&#xe604;</i></a>
									<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$v['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
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
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
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

/*图片-下架*/
function picture_stop(obj,id){
	layer.confirm('确认要下架吗？',function(index){
		window.location.href="{{asset('/admin/pdo/sta')}}?id="+id;
		layer.msg('已下架!',{icon: 5,time:1000});

		
		
		//此处请求后台程序，下方是成功后的前台处理……
	});
}

/*图片-发布*/
function picture_start(obj,id){
	layer.confirm('确认要上架吗？',function(index){
		window.location.href="{{asset('/admin/pdo/sta')}}?id="+id;
		layer.msg('已上架!',{icon: 6,time:1000});

		
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
		window.location.href="{{asset('/admin/pdo/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……

		$(obj).parents("tr").remove();
		layer.alert('已删除!',{icon:1,time:1000});
	});
}
function member_show(title,url,id,w,h){
	layer_show(title,"{{asset('/admin/pdo/ulist')}}?id="+id,w,h);
}
</script>

@endsection
