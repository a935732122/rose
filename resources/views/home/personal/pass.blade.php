
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="{{asset('home/css/grzx.css')}}">
	<script src = "{{asset('home/js/jquery.js')}}"></script>
	<script src = "{{asset('home/js/list.js')}}"></script>
	<!-- <script src="js/grzx.js"></script> -->
</head>
<body>
	<div class="aheader">
			<div class ="logo">
				<div class ="logo1">
				<a href="{{asset('home/index')}}">
						<img src="{{asset('home/image/index.png')}}" alt="">
						<div id="logo1" >
							<img src="{{asset('home/image/index2.png')}}" alt="">
						</div></a>
				</div>
				<div class ="logo2">
				<a href="{{asset('home/list/index')}}/2">

						<img src="{{asset('home/image/index1.png')}}" alt="" width="128px" height="35px">
						<div id="logo2" >
							<img src="{{asset('home/image/index3.png')}}" alt="" width="128px" height="35px">
						</div>
						</a>
				</div>
				<div class="login">

					<p>@if(session()->get("name"))
								<a href="{{asset('home/personal/index')}}" target="_top" class="h">个人中心</a>
								<a href=""></a>
								<a href="{{asset('home/login/outlogin')}}">退出</a>
							@else
							<a href="{{asset('home/login/index')}}">登录</a>
						<span>|</span>
						<span><a href="">注册</a></span>
							@endif

					</p>
					<p>
						<a href=""><img src="{{asset('home/image/shop.png')}}" alt="" width="20px" height="20px"></a>

						
					</p>
					<p>
						<span>(0)</span>
					</p>
				</div>
			</div>
			
	
	</div>	
	<div class="conter">
		<div class="logo_head">
		
		<a href="" class="logo_hd_im">
		<div class="logo_head1"><img src="{{asset('home/image/logo1.jpg')}}">
		</div></a>
		</div>


		<div>
		<div class="nav-container">
				<div class="main_view_line2"></div>
		</div>
		</div>


		<div class="mu_wrap wrap clearfix">
			<div class="mu_nav_wrap"> 
				
			 	<!-- 订单 -->
			 	<div class="mu_nav">
				  	<div class="mu_title"><a href="{{asset('home/personal/index')}}">我的订单</a></div> 
			    </div>
				 <div class="mu_nav"> 
			    	<div class="mu_title"><li><a href="{{asset('home/personal/center')}}">信息管理</a></li></div> 
			   	</div>
			    <div class="mu_nav"> 
				    <div class="mu_title"><a href="{{asset('home/personal/edit')}}" style="color:red">修改密码</a></div> 
			    </div> 
			   
			   	 <div class="mu_nav"> 
			    	<div class="mu_title"><li><a href="{{asset('home/personal/address')}}">地址管理</a></li></div> 
			   	</div>
			</div>
			<div style="float:left;width:70%;text-align: center">
				<form action="{{asset('home/personal/update')}}" method="post" style="margin-top: 80px">
				<table id="con_wdxx_2" style="min-height:220px; font-size:14px; width:100%; padding-left:10px; margin-bottom:80px;">
					<tbody><tr>

						<td class="txtr" style="text-align: right;width: 160px;padding-right: 20px;"><span>*</span>旧 密 码</td>
						<td style="width:400px">
							<input type="hidden" value="{{$list['id']}}" name="id">
							<input id="oldpass" class="wdxx_txt_date" type="password" name="oldpass" maxlength="12" style="width: 170px;height: 30px;text-indent: 8px;border: solid 1px #83847e;color: #83847e;">
							<span id="span_oldpass" style="color: red;"></span>
						</td>
						<td width="225"></td>
					</tr>
					<tr>
						<td class="txtr" style="text-align: right;width: 160px;padding-right: 20px;"><span>*</span>新 密 码</td>
						<td width="570">
							<input id="userpass" class="wdxx_txt_date" type="password" name="userpass" maxlength="12" style="width: 170px;height: 30px;text-indent: 8px;border: solid 1px #83847e;color: #83847e;">
							<span id="span_userpass" style="color: red;"> </span>
						</td>
						<td width="225"></td>
					</tr>
					<tr>
						<td class="txtr" style="text-align: right;width: 160px;padding-right: 20px;"><span>*</span>确认新密码</td>
						<td>
							<input id="newpass" class="wdxx_txt_date" type="password" name="newpass" maxlength="12" style="width: 170px;height: 30px;text-indent: 8px;border: solid 1px #83847e;color: #83847e;">
							<span id="span_newpass" style="color: red;"></span>
						</td>
						<td></td>
					</tr>
					<tr>
						<td class="txtr"></td>
						<td><input type="image" src="http://www.roseonly.com.cn/index/images/pe.gif" id="button_img" onclick="return checkInfo();"></td>
						<td></td>
					</tr>
				
				</tbody></table>
			
				<div class="clear">
				</div>
				
				{{csrf_field()}}
				</form>
					@if(Session::has('message'))
					
					<span style="color:red;padding-bottom: 20px">
					{{Session::get('message')}}
					</span>
					@endif
						@if (count($errors) > 0)
					错误信息：
						
							
		        @foreach ($errors->all() as $error)
		           <span style="color:red;padding-bottom: 20px">{{ $error }}
		           </span>
		        @endforeach   
				@endif 
			</div>


		</div>
		</div>



		<div class="main_view_line2"></div>
	</div>
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