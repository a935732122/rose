@extends('home.base')
@section('title','前台登陆')
@section('content')
<div class="login_bg">
		<div class="login_cn">
				<a href="" class="dian"></a>
			<form class="table" action="{{asset('home/login/save')}}" method="post">
				<div class="lg_con" style="padding-top: 30px;height:525px">
					
					<div class="pos">
						<input type="text" name="name" placeholder="用户名" " class="pod_te">
				
					</div>

					<div class="pos">
						<input type="password" name="pass" placeholder="请输入密码"  class="pod_te">
						
					</div>
						<div class="pos">
						<input type="text" name="phone" placeholder="请输入手机" " class="pod_te">
				
					</div>
					<div class="phone">
						<input type="text" name="email" placeholder="请输入邮箱"  class="pod_te">
				
					</div>
					<div class="pos" >
					 	<input type="text" name="captcha" placeholder="验证码"  class="pod_te" style='width:150px;float: left'>
						<div style="float: left">
							<img  style="margin-left:10px;margin-top:6px " src="{{captcha_src()}}" onclick="this.src=this.src+'?id='+Math.random()">
						</div>
						
					 </div>
					<div class="kuai">
						<a href="{{asset('home/login/index')}}" class="kuai_left">已有账号</a>
						
					</div>
					
						<button class="button">注册</button>
							{{csrf_field()}}
							@if (count($errors) > 0)
					<div style="margin-top: 10px">
						<label style="color:red;margin-left:100px">错误信息：</label>
						<div class="formControls col-xs-8 col-sm-5">
							<ul style="color:red;margin-left:150px">
							        @foreach ($errors->all() as $error)
							            <li>{{ $error }}</li>
							        @endforeach
							        </ul>
						</div>
					</div>	    
				@endif
					@if(Session::has('message'))
										<div style="color:red;margin-left:150px;margin-top: 50px">
									        {{Session::get('message')}}
									    </div>
									@endif
				</div>

			</form>
		</div>
	</div>
@endsection