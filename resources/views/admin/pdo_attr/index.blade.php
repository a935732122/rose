@extends('admin.base')
@section('title','后台主页')

@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 商品管理 <span class="c-gray en">&gt;</span> 属性列表 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
			<form class="form form-horizontal"  method="get" action="{{asset('admin/pdo_attr/index')}}" >
				<input type="text" name="attr" id="" placeholder=" 属性名称" style="width:250px" class="input-text" value="{{$search['attr'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜属性</button>
				{{csrf_field()}}

			</form>
			</div>
		
			<div class="cl pd-5 bg-1 bk-gray mt-20"> 
				<span class="l"> <a class="btn btn-primary radius"  href="{{asset('admin/pdo_attr/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加</a></span> 
				@if(Session::has('message'))
				<span style="padding-left:36%;color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
				@endif
				<span class="r">共有数据：<strong>{{$num}}</strong> 条</span> 
			</div>
			
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th>类别ID</th>
							<th>属性名字</th>
							<th>商品类型</th>
							<th>创建时间</th>
							<th>修改时间</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $k=>$v)
						<tr class="text-c">
								<td>{{$v->id}}</td>
								<td>{{$v['attr']}}</td>
								<td>{{$v->pdo_type->type}}</td>
								<td>{{$v['created_at']}}</td>
								<td>{{$v['updated_at']}}</td>
								<td class="td-manage">
									
									<a style="text-decoration:none" class="ml-5"  href="{{asset('admin/pdo_attr/edit')}}/{{$v['id']}}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> 

									<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$v['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a>
								</td>
						</tr>
						@endforeach
					</tbody>
				</table>
				{!! $list->appends(['attr'=>$search['attr']])->render() !!}



			
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
		window.location.href="{{asset('/admin/pdo_attr/del')}}/"+id;
	});
}

</script>

@endsection
