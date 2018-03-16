@extends('home.base')
@section('title','后台主页')
@section('content')
<div class="login_bg">
		<div class="login_cn">
				<a href="" class="dian"></a>
			<form class="table" action="{{asset('home/login/update')}}" method="post">
				<div class="lg_con" style="padding-top: 30px;height:525px">
					
					<div class="pos">
						<input type="text" name="name" placeholder="用户名" " class="pod_te">
				
					</div>

					<div class="pos">
						<input type="password" name="pass" placeholder="请输入新密码"  class="pod_te">
						
					</div>
					<div class="pos">
						<input type="password" name="apass" placeholder="确认密码"  class="pod_te">
						
					</div>
						<div class="pos">
						<input type="text" name="phone" placeholder="请输入手机" " class="pod_te">
				
					</div>
					
					 <div class="pos" >
					 	<input type="text" name="captcha" placeholder="验证码"  class="pod_te" style='width:150px;float: left'>
						<div style="float: left">
							<button type="button" id="li" style="height:45px;margin-left:35px">免费获取验证码</button>
						</div>
						<input type="hidden" id="phc" name="phc">
					 </div>
					<div class="kuai">
						<a href="{{asset('home/login/index')}}" class="kuai_left">已有账号</a>
						
					</div>
					
						<button class="button">提交</button>
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
	<script>
	
		$("#li").click (function(){
			var tel = $("#tel").val();
			$.get("sms",{tel:tel},function(data){
				$('#phc').val($.trim(data));
					
			});
		});
	</script>
@endsection