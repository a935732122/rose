﻿@extends('admin.base')
@section('title','角色管理')
@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		角色管理
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				
				<form class="form form-horizontal"  method="get" action="{{asset('admin/role/index')}}" >
				<input type="text" name="name" id="" placeholder="用户名" style="width:250px" class="input-text" value="{{$search['name'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜角色</button>
				{{csrf_field()}}

			</form>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				<a class="btn btn-primary radius" data-title="添加资讯" _href="article-add.html"  href="{{asset('admin/role/add')}}"><i class="Hui-iconfont">&#xe600;</i> 添加</a>
				</span>
				@if(Session::has('message'))
				<span style="padding-left:36%;color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
				@endif
				<span class="r">共有数据：<strong>{{$num}}</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							
							<th>ID</th>
							<th>角色</th>
							<th>角色名</th>
							<th>创建时间</th>
							<th>修改时间</th>
							
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
							 @foreach($roles as $sole)
			              <tr class="text-c">
			                
			                <td>{{ $sole['id'] }}</td>
			                <td><a href="#">{{ $sole['name'] }}</a></td>
			                <td>{{ $sole['display_name'] }}</td>
			                <td>{{ $sole['created_at'] }}</td>
			                <td>{{ $sole['updated_at'] }}</td>
			                <td class="f-14 td-manage">
								<a style="text-decoration:none" class="ml-5" href="{{asset
								('admin/role/edit')}}/{{$sole['id']}}" title="修改"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$sole['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			              </tr>
			              @endforeach
						
					</tbody>
				</table>
				{!! $roles->appends(['name'=>$search['name']])->render() !!}
			</div>
		</article>
	</div>
</section>
<script>
	/*管理员-删除*/
	function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href="{{asset('/admin/role/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……
		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
</script>
@endsection('content')