<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title></title>	
		<link rel="stylesheet" href="{{asset('assets/css/core.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/menu.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/amazeui.css')}}" />
		<link rel="stylesheet" href="{{asset('ssets/css/component.css')}}" />
		<link rel="stylesheet" href="{{asset('assets/css/page/form.css')}}" />
	</head>
	<body>
		<div class="account-pages">
			<div class="wrapper-page">
				<div class="text-center">
	                <a href="index.html" class="logo"><span>Admin<span>to</span></span></a>
	            </div>
	            
	            <div class="m-t-40 card-box">
	            	<div class="text-center">
	                    <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
	                </div>
	                <div class="panel-body">
	                	<form class="am-form" action="{{url('auth/login')}}" method="post">
	                		
	                		<div class="am-g">
	                			<div class="am-form-group">
							      <input type="email" class="am-radius" name="email"  placeholder="email" value="{{ old('email') }}">
							    </div>
							
							    <div class="am-form-group form-horizontal m-t-20">
							      <input type="password" class="am-radius" name="password"  placeholder="Password" value="{{ old('password') }}">
							    </div>

							    <div class="am-form-group form-horizontal m-t-20" style="width:120px;">
							     <div style="height: 40px">
							     	 <input type="text" class="am-radius" name="captcha"  placeholder="captcha">

							        <img  style="margin-left:130px;margin-top:-68px " src="{{captcha_src()}}" onclick="this.src=this.src+'?id='+Math.random()">
							     </div>
							    </div>

							    <div class="am-form-group ">
		                           	<label style="font-weight: normal;color: #999;">
								        <input type="checkbox" name="remeber" value="1" class="remeber"> Remember me
								    </label>
		                        </div>
		                        	{{csrf_field()}}
		                        <div class="am-form-group ">
		                        	<button type="submit" class="am-btn am-btn-primary am-radius" style="width: 100%;height: 100%;">Log In</button>
		                        </div>
		                        <div class="am-form-group ">
		                        <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Forgot your password?</a>
		                        </div>
		                       
		                         <div class="am-form-group ">
		                        <a href="javascript:;" class="text-muted">
			                        @if (count($errors) > 0)
									    <div class="alert alert-danger">
									        <ul style="color:red;">
									        @foreach ($errors->all() as $error)
									            <li>{{ $error }}</li>
									        @endforeach
									        </ul>
									    </div>
									@endif
									@if(Session::has('message'))
										<div class="alert alert-danger">
									        {{Session::get('message')}}
									    </div>
									@endif

		                        </a>
		                        </div>
	                		</div>

	                	</form>
							
	                </div>
	            </div>
			</div>
		</div>
	</body>
</html>
