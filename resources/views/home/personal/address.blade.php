
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="{{asset('home/css/grzx.css')}}">
	<link href="http://www.roseonly.com.cn/assets/roseonly/css/public.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="http://orders.roseonly.com.cn/resources/usercenter/css/style_userinfo.css" />
	<script src="http://orders.roseonly.com.cn/resources/My97DatePicker/WdatePicker.js" type="text/javascript"></script>
	<script type="text/javascript" src="http://orders.roseonly.com.cn/resources/jquery/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="http://www.roseonly.com.cn/index/myjs/qy.js" ></script>
	<script type="text/javascript" src="http://www.roseonly.com.cn/scripts/myjs/qyutil.js" ></script>
	<link rel="stylesheet" href="{{asset('home/css/grzx.css')}}">
	<script src = "{{asset('home/js/jquery.js')}}"></script>
	<script src = "{{asset('home/js/area.js')}}"></script>
	<script src = "{{asset('home/js/list.js')}}"></script>

<title>收货地址</title>
<link rel="stylesheet" type="text/css" href="http://orders.roseonly.com.cn/resources/css/infor.css" />
<link rel="stylesheet" type="text/css" href="http://orders.roseonly.com.cn/resources/css/user/address.css" />
<script type="text/javascript" src="http://orders.roseonly.com.cn/resources/js/jquery.select.js"></script>
<script type="text/javascript" src="{{asset('home/js/address.js')}}"></script>
</head>
<body>
	<!--头部start--> 
	<div class="aheader">
			<div class ="logo">
				<div class ="logo1">
				<a href="{{asset('home/index')}}">
						<img src="{{asset('home/image/index.png')}}" alt="">
						<div id="logo1" style="margin-top: -83px">
							<img src="{{asset('home/image/index2.png')}}" alt="">
						</div></a>
				</div>
				<div class ="logo2">
				<a href="{{asset('home/list/index')}}/2">

						<img src="{{asset('home/image/index1.png')}}" alt="" width="128px" height="35px">
						<div id="logo2" style="margin-top:-35px">
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
						<span><a href="{{asset('home/login/add')}}">注册</a></span>
							@endif

					</p>
					<p>
						<a href="{{asset('home/shop/index')}}"><img src="{{asset('home/image/shop.png')}}" alt="" width="20px" height="20px"></a>

						
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


<div style="clear:both;"></div>
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
				    <div class="mu_title"><a href="{{asset('home/personal/edit')}}">修改密码</a></div> 
			    </div> 
			   
			   	 <div class="mu_nav"> 
			    	<div class="mu_title"><li><a href="{{asset('home/personal/address')}}" style="color:red">地址管理</a></li></div> 
			   	</div>
			</div>
			<div id="addressListDiv" style="float:left;width:70%;text-align: center">
			  <div class="mod_address">
			  	<ul>
			  		@foreach($mm as $v)
				  	 <li class="">
				  	 	<span class="nickname">{{$v['name']}}<em>收</em></span>
			           <span class="addressname"><strong>{{$v['s_province']}}</strong><strong>{{$v['s_city']}}</strong><strong>{{$v['s_county']}}</strong><em style="font-style:normal">{{$v['address']}}</em></span
			            <span class="mobilenumber">
			                 {{$list['phone']}}</span>
			            <div class="opera">
			                <!--如果这里出现2操作就在第一个上面加oneMore,出现3个的加More-->
			                <a href="{{asset('home/personal/update')}}?id={{$v['id']}}" class="black oneMore">编辑</a>
							@if($v['da']==1)
			                默认地址
			                @else
			                 <a href="{{asset('home/personal/ad')}}?id={{$v['id']}}" class="blue">设为默认地址</a>
			                </div>
			                @endif
			            <a href="{{asset('home/personal/del')}}?id={{$v['id']}}" class="li_p_del" style="display: none;">
			                <img src="http://orders.roseonly.com.cn/resources/images/del_icon.png"/>
			            </a>
			           
			         
			        </li>
			           @endforeach
		  		</ul>
			  	<a href="#saveAddressDiv" onclick="popWinAddressDiv();" class="add_address">
		                  	添加新地址
		       </a>
		  	</div>
		  	</div>
		  	<form  method="post" action="{{asset('home/personal/save')}}">
		  	<div id="saveAddressDiv" class="manage-right2" style="display:none">
				<div class="manage-left" id="manage-left">新增收货地址</div>
					
					<input type="hidden" id="addressid" name="id" value="" />
					<div id="consignee_addr" class="hide" >
						<table width="700" height="150" border="0" cellspacing="0">
							<tr>
								<td width="100" align="left" style="color:#83847e"><font style="color:red">*</font>&nbsp;收货人</td>
								<td width="250" align="left" class="cor-2"><input
									id="name" name="name"
									value=""
									class="txt" type="text"
									
									maxlength="11"
									style="width:200px; height:30px; border:solid 1px #ededed;" />
								</td>
								<td width="150"></td>
								<td width="200"></td>
							</tr>
							<tr>
								<td align="left" style="color:#83847e;"><font style="color:red">*</font>&nbsp;手机号码</td>
								<td align="left" class="cor-2"><input id="mobile" class="txt"
									type="text" maxlength="11" name="phone"
									style="width:200px; height:30px; border:solid 1px #ededed;"
									 />
								</td>
							</tr>		
							<tr>			
								<td align="left" style="color:#83847e"><font style="color:red">&nbsp;</font>&nbsp;电子邮件</td>
								<td align="left" class="cor-2"><input id="address_email"
									class="txt" type="text" value="" name="email"
									style="width:200px; height:30px; border:solid 1px #ededed;" />
								</td>
							</tr>
							<tr>
								<td align="left" style="color:#83847e"><font style="color:red">*</font>&nbsp;省&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;份</td>
								<td align="left" colspan="3" class="cor-2">
									<span id="consignee_arae">
										 <!-- 省市三级联动 -->
									    <select id="s_province" name="s_province" style="width:90px; height:30px; line-height:30px; 
									    	border:solid 1px #ededed;">
									    	<option></option>
									        </select>
									    <select id="s_city" name="s_city" style="width:90px; height:30px; line-height:30px; 
									    	border:solid 1px #ededed;">
									    </select>
									    <select id="s_county" name="s_county" style="width:90px; height:30px; line-height:30px; 
									    	border:solid 1px #ededed;">
									    </select>
									  	  <script class="resources library" src="{{asset('home/js/area.js')}}" type="text/javascript"></script>

    

   										 <script type="text/javascript">_init_area();</script>
									</span>
								</td>
							</tr>
							<tr>
								<td align="left" style="color:#83847e"><font style="color:red">*</font>&nbsp;地&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;址</td>
								<td align="left" colspan="3" class="cor-2"><span
									id="consigneeShow_addressName"></span> <input id="address"
									class="txt" type="text" maxlength="50"
									style="width:600px; height:30px; border:solid 1px #ededed;"
									name="address" /></td>
							</tr>
			
							<div class="address-box address_zip_div_class" id="address_zip_div" style="display: none;">
								<ul id="address_zip_ui" style="height:200px; width:600px;">
								</ul>
							</div>
			

						</table>
											<div id="e_m"
							style="color: red;width:200px;height: 30px;line-height: 30px;float: right;margin-top: 10px;">
						</div>
					</div>
					
					<div class="clear"></div>					
                <div class="save" style="margin-right: 50px"><input type="submit"  style="width: 100px;height: 30px;border:0;cursor: pointer;"/></div>					
				<div class="clear"></div>
				
			</div>
			{{csrf_field()}}
			</form>
			@if(Session::has('message'))
				<span style="padding-left:42%;color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
			@endif
			<!--右侧内容 结束  -->
		</div>
		<div style="clear:both;"></div>
		<div class="main_view_line2"></div>
	</div>
	<!-- http://www.roseonly.com.cn/index/include/footer1.jsp -->
<script type="text/javascript" src="http://www.roseonly.com.cn/index/js/fdj.js"></script>
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

	
<script type="text/javascript"> 


function clickDeleteAdderss(obj,id){
		window.location.href="{{asset('/home/personal/del')}}/"+id;
}

function aaa{
	window.location.href="{{asset('/home/personal/save')}}";
}								 
									

</script>
<script type="text/javascript" src="http://www.roseonly.com.cn/assets/jquery/Base.js"></script>
</body>
</html>