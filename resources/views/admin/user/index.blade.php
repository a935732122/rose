@extends('admin.base')
@section('title','后台主页')
@section('content')

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		管理员管理
		<span class="c-gray en">&gt;</span>
		用户管理
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				
				<form class="form form-horizontal"  method="get" action="{{asset('admin/user/index')}}" >
				<input type="text" name="name" id="" placeholder="用户名" style="width:250px" class="input-text" value="{{$search['name'] or ''}}">

				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
				{{csrf_field()}}

			</form>
			</div>
			
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				
				<a class="btn btn-primary radius" data-title="添加" href="{{asset('admin/user/add')}}"  href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a>
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
							<th>用户名</th>
							<th>邮箱</th>
						
							<th>创建时间</th>
							<th>修改时间</th>
							<th>状态</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>

						 @foreach($users as $user)
			              <tr class="text-c">
			                
			                <td>{{ $user['id'] }}</td>
			                <td><a href="#">{{ $user['name'] }}</a></td>
			                <td>{{ $user['email'] }}</td>
			                <td>{{ $user['created_at'] }}</td>
			                <td>{{ $user['updated_at'] }}</td>
			                <td>{!! $user['status'] !!}</td>
			                <td class="f-14 td-manage">
			                	@if($user->getOriginal('status')==1)
									<a style="text-decoration:none" onClick="article_stop(this,'{{$user['id']}}')" href="javascript:;" title="禁用">
									<i class="Hui-iconfont">&#xe6de;</i></a> 
									@elseif($user->getOriginal('status')==2)
									<a style="text-decoration:none" onClick="article_start(this,'{{$user['id']}}')" href="javascript:;" title="启用">
									<i class="Hui-iconfont">&#xe603;</i></a> 
								@endif
								<a style="text-decoration:none" class="ml-5" href="{{asset('admin/user/role')}}/{{ $user['id'] }}" title="分配角色"><i class="Hui-iconfont">&#xe63c;</i></a>
								<a style="text-decoration:none" class="ml-5" href="{{asset('admin/user/edit')}}/{{ $user['id'] }}" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="picture_del(this,'{{$user['id']}}')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
			              </tr>
			              @endforeach
					</tbody>
				</table>
				{!! $users->appends(['name'=>$search['name']])->render() !!}
			</div>
		</article>
	</div>
</section>

<script type="text/javascript">
/*图片-禁用*/
function article_stop(obj,id){
	layer.confirm('确认要禁用吗？',function(index){
		window.location.href="{{asset('/admin/user/sta')}}/"+id;
		layer.msg('已禁用!',{icon: 5,time:1000});

	});
}

/*图片-启用*/
function article_start(obj,id){
	layer.confirm('确认要启用吗？',function(index){
		window.location.href="{{asset('/admin/user/sta')}}/"+id;
		layer.msg('已启用!',{icon: 6,time:1000});
	});
}
/*用户-删除*/
function picture_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		window.location.href="{{asset('/admin/user/del')}}/"+id;
		//此处请求后台程序，下方是成功后的前台处理……

		$(obj).parents("tr").remove();
		layer.msg('已删除!',{icon:1,time:1000});
	});
}
</script>
@endsection