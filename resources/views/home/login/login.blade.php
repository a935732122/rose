@extends('home.base')
@section('title','前台登陆')
@section('content')
<div class="login_bg">
		<div class="login_cn">
				<a href="" class="dian"></a>
			<form class="table" action="{{asset('home/login/dologin')}}" method="post">
				<div class="lg_con">
					
					<div class="pos">
						<input type="text" name="name" placeholder="用户名" " class="pod_te">
				
					</div>
					<div class="pos">
						<input type="password" name="pass" placeholder="请输入密码"  class="pod_te">
						
					</div>

					<div class="kuai">
						<a href="{{asset('home/login/add')}}" class="kuai_left">快速注册</a>
						<a href="{{asset('home/login/edit')}}" class="kuai_right">忘记密码？</a>
					</div>
						<button class="button">登录</button>
							{{csrf_field()}}
							@if (count($errors) > 0)
					<div style="margin-top: 50px">
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