@extends('admin.base')
@section('title','后台主页')

@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 订单管理 <span class="c-gray en">&gt;</span> 订单列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
			<form class="form form-horizontal"  method="get" action="{{asset('admin/cart/index')}}" >
				<input type="text" name="name" id="" placeholder=" 店名" style="width:250px" class="input-text" value="{{$search['name'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
				{{csrf_field()}}

			</form>
			</div>
		
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l"> <a class="btn btn-primary radius"  href="{{asset('admin/dian/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加店面</a></span>
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
							<th width="419">店名</th>
							<th width="419">地址</th>
							<th width="419">营业时间</th>
							<th width= "419">电话</th>
							<th width= "419">所属城市</th>
							<th width= "419">操作</th>
						</tr>
					</thead>
					<tbody>
					@foreach($list as $v)
						<tr class="text-c">	
							<td>{{$v['id']}}</td>
							<td>{{$v['name']}}</td>
							<td>{{$v['adress']}}</td>
							<td>{{$v['time']}}</td>
							<td>{{$v['tel']}}</td>
							<td>{{$v->provice->name}}</td>
							<td class="td-manage">
								
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/dian/edit')}}/{{$v['id']}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 
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


/*图片-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href="{{asset('/admin/dian/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……

		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
function member_show(title,url,id,w,h){
	layer_show(title,"{{asset('/admin/indent/ulist')}}?id="+id,w,h);
}
</script>


@endsection
