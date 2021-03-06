<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="{{asset('home/css/rose.css')}}">

	<link rel="stylesheet" type="text/css" href="{{asset('home/css/login.css')}}">
	<link rel="stylesheet" href="{{asset('home/css/nuoyanshijie.css')}}">
	<script src = "{{asset('home/js/jquery.js')}}"></script>
	<script src = "{{asset('home/js/list.js')}}"></script>
	<link href="{{asset('home/css/lanrenzhijia1.css')}}" type="text/css" rel="stylesheet">
	<link href="{{asset('home/css/lanrenzhijia.css')}}" type="text/css" rel="stylesheet">
	
	
	
	<script type="text/javascript" src="{{asset('home/js/jquery-1.7.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('home/js/jquery.preloader.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('home/js/jquery.nivo.slider.pack.js')}}"></script>
	
	
	<script type="text/javascript" src="{{asset('home/js/carts.js')}}"></script>
	@section('js')
	@show

<title>@yield('title')</title>

</head>
<body>
	<div class="aheader">
			<div class ="logo">
				<div class ="logo1">
				<a href="{{asset('home/index')}}">
						<img src="{{asset('home/image/index.png')}}" alt="">
						<div id="logo1">
							<img src="{{asset('home/image/index2.png')}}" alt="">
						</div></a>
				</div>
				<div class ="logo2">
				<a href="{{asset('home/list/index')}}/2">

						<img src="{{asset('home/image/index1.png')}}" alt="" width="128px" height="35px">
						<div id="logo2">
							<img src="{{asset('home/image/index3.png')}}" alt="" width="128px" height="35px">
						</div>
						</a>
				</div>
				<div style="float: left;margin-left: 200px;margin-top: 5px">
					<form action="{{asset('home/list/sousuo')}}">
					<input type="text" style="background: #E7E7E7;border:1px solid #C8CACC;width:200px;height:20px" placeholder="商品名称" value="{{$search['title'] or ''}}" name="name">
					<button style="width:50px;height:20px;background:#C8CACC;border:0px">搜索</button>
				</form>
				@if(Session::has('ss'))
										<div style="color:red;">
									        {{Session::get('ss')}}
									    </div>
									@endif
				</div>
				
				<div class="login">

					<p>
						@if(session()->get("name"))
								<a href="{{asset('home/personal/index')}}" target="_top" class="h" style="">个人中心</a>
								丨
								<a href="{{asset('home/login/outlogin')}}" style="">退出</a>
							@else
							<a href="{{asset('home/login/index')}}" style="">登录</a>
						<span>|</span>
						<span><a href="{{asset('home/login/add')}}">注册</a></span>
							@endif
						</p>
					<p>
						<a href="{{asset('home/shop/index')}}"><img src="{{asset('home/image/shop.png')}}" alt="" width="20px" height="20px"></a>

						
					</p>
					
				</div>
			</div>
			
	
	</div>	
	<div class="logo_head">
		
		<a href="" class="logo_hd_im">
		<div class="logo_head1"><img src="{{asset('home/image/logo1.jpg')}}">
		</div></a>
		
		<div class="nav" id = "nav1">
			<div class="nav_text">
				<ul>
					@foreach($nav2 as $v)
					<li>
			
				<a href="{{asset('home/list/index')}}/{{$v['id']}}" class="nav1_two">{{$v['name']}}</a>
					
				
			
						@foreach($nav3 as $vs)
						@if($v['id']==$vs['pid'])
						
						<div class="meau">
							<div class="meau_f">
								<div class="meau_r">
									@foreach($nav3 as $vs)
									@if($v['id']==$vs['pid'])
									
									<a href=""><span class="text1">{{$vs['name']}}</span>
									</a>
									
									@endif
									@endforeach
								</div>
								<div class="meau_r meau_rl">
									<a href=""></a>
									@foreach($nav3 as $vs)
									@if($v['id']==$vs['pid'])
									@foreach($nav4 as $vm)
									@if($vs['id']==$vm['pid'])
									<a href="{{asset('home/list/index')}}/{{$vm['id']}}" style="display: block"><span class="text2" style="display: block">{{$vm['name']}}</span>
									</a>
									@endif
									@endforeach	
									@endif
									@endforeach	
								</div>
								@if($v['image'])
								<a href="" class="meau_pic">
									<img src="{{$v['image']}}">
								</a>
								@endif
							</div>
						</div>
						@endif
					
						@endforeach
					</li>
					@endforeach
				</ul>
			</div>
		</div>
		<div class="nav1" style="display: none;position:fixed;  z-index:999;" id="nav">
			<div class="nav1_text">
					<a href="{{asset('home/index')}}" class="nav1_three">roseonly.</a>
				<ul>
					@foreach($nav2 as $v)
					<li>
					<a href="{{asset('home/list/index')}}/{{$v['id']}}" class="nav1_two">{{$v['name']}}</a>
						@foreach($nav3 as $vs)
						@if($v['id']==$vs['pid'])
						<div class="meau">
							<div class="meau_f">
								<div class="meau_r">
									@foreach($nav3 as $vs)
									@if($v['id']==$vs['pid'])
									<a href=""><span class="text1">{{$vs['name']}}</span>
									</a>
									@endif
									@endforeach
								</div>
								<div class="meau_r meau_rl">
									@foreach($nav3 as $vs)
									@if($v['id']==$vs['pid'])
									@foreach($nav4 as $vm)
									@if($vs['id']==$vm['pid'])
									<a href="{{asset('home/list/index')}}/{{$vm['id']}}"><span class="text2">{{$vm['name']}}</span>
									</a>
									@endif
									@endforeach	
									@endif
									@endforeach	
								</div>
								@if($v['image'])
								<a href="" class="meau_pic">
									<img src="{{$v['image']}}">
								</a>
								@endif
							</div>
						</div>
						@endif
						@endforeach
					</li>
					@endforeach
					<div class= "nav1right">
						<p>
						@if(session()->get("name"))
								<a href="{{asset('home/personal/index')}}" target="_top" class="h" style="color:white">个人中心</a>
								丨
								<a href="{{asset('home/login/outlogin')}}" style="color:white">退出</a>
							@else
							<a href="{{asset('home/login/index')}}" style="color:white">登录</a>
						<span>|</span>
						<span><a href="{{asset('home/login/add')}}" style="color:white">注册</a></span>
							@endif
						</p>
						<p>
								<a href="{{asset('home/shop/index')}}"><img src="{{asset('/home/image/shop1.png')}}" alt="" width="20px" height="30px"></a>

								
						</p>
						
				
					</div>
				</ul>
			</div>
		</div>
	
@section('content')
@show
	
	<!-- 结束 -->
		<div class="end">
			<div class="ed_cn">
				<a href="" class="ed_bg1">
					<div class="ed_top">全场包邮
						<span class="ed_bo">特殊礼品除外</span>
					</div>
				</a>
				<a href="" class="ed_bg2">
					<div class="ed_top">同城速递
						<span class="ed_bo">支持当日送达</span>
					</div>
				</a>
				<a href="" class="ed_bg3">
					<div class="ed_top">爱的留言
						<span class="ed_bo">支持语音与文字，可随时查阅</span>
					</div>
				</a>
				<a href="" class="ed_bg4">
					<div class="ed_top">保养物语
						<span class="ed_bo">悉心保养，恒久保存爱意</span>
					</div>
				</a>
			</div>
		</div>
	<!-- 页脚 -->
	<div class="foot_box">
		<div class="ft_cn">
			<a href=""><img src="{{asset('home/image/ft.png')}}" alt=""></a>
			<div class="ft_gz">关注我们
				<a href="" class="gz_b"><img src="{{asset('home/image/wx.png')}}"></a>
				<a href="" class="gz_x"><img src="{{asset('home/image/wb.png')}}"></a>
			</div>
		</div>
		<ul>
			<li><P>新手指南</P></li>
			<li><a href="">购物流程</a></li>
			<li><a href="">支付方式</a></li>
			<li><a href="">常见问题</a></li>
			<li><a href="">指圈测量</a></li>
		</ul>
		<ul>
			<li><P>售后服务</P></li>
			<li><a href="">退款说明</a></li>
			<li><a href="">保养无语</a></li>
		</ul>
		<ul>
			<li><P>物流配送</P></li>
			<li><a href="">配送方式</a></li>
			<li><a href="">配送服务</a></li>
		</ul>
		<ul style="border-right: none">
			<li><P>关于我们</P></li>
			<li><a href="">品牌介绍</a></li>
			<li><a href="">联系我们</a></li>
			<li><a href="">加入我们</a></li>
		</ul>
		<div class="guan2">
			<a href=""><img src="{{asset('home/image/guan2.png')}}"></a>
			<p>微博关注roseonly</p>
		</div>
		<div class="guan1">
			<a href=""><img src="{{asset('home/image/guan1.png')}}"></a>
			<p>微信关注roseonly</p>
		</div>
	</div>

	<div class ="foot">
				<div>京ICP备13007738号 京公网安备11010502023922 www.roseonly.com.cn；诺誓（北京）商业股份有限公司 </div>

	</div>
	
</body>

</html>	