
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
						<a href="{{asset('home/index/index')}}"><img src="{{asset('home/image/index.png')}}" alt="">
						<div id="logo1" style="margin-top: -83px">
							<img src="{{asset('home/image/index2.png')}}" alt="">
						</div></a>
				</div>
				<div class ="logo2">
				<a href="{{asset('home/list/index')}}/2">
						<img src="{{asset('home/image/index1.png')}}" alt="" width="128px" height="35px">
						<div id="logo2"  style="margin-top: -35px">
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
				  	<div class="mu_title" style="color:red">我的订单</div> 
				  	<ul class="mu_nav_item">
					   	<li> 
					   	<a href="">全部订单</a> 
					   	</li> 
					   	<li> <a href=""> 待付款 <i id="unpaidOrder" class="mu_nav_count"><i class="mu_nav_count_arw"></i></i> </a> </li> 
					   	<li> <a href=""> 待收货 <i id="unReceivedOrder" class="mu_nav_count"><i class="mu_nav_count_arw"></i></i> </a> </li> 
					   	<li> <a href=""> 待评价 <i id="waitingRateOrder" class="mu_nav_count"><i class="mu_nav_count_arw"></i></i> </a> </li> 
					   	<li> <a href=""> 退货退款 <i class="mu_nav_count"><i class="mu_nav_count_arw"></i></i> </a> </li>
				    </ul>
			    </div> 
				 <div class="mu_nav"> 
			    	<div class="mu_title"><li><a href="{{asset('home/personal/center')}}">信息管理</a></li></div> 
			   	</div>
			    <div class="mu_nav"> 
				    <div class="mu_title"><a href="{{asset('home/personal/edit')}}">修改密码</a></div> 
			    </div> 
			   
			   	 <div class="mu_nav"> 
			    	<div class="mu_title"><li><a href="{{asset('home/personal/address')}}" >地址管理</a></li></div> 
			   	</div>
			</div>
			<div id="addressListDiv" style="float:left;width:80%;text-align: center">
			  <div class="mod_address">
			  	<div id="saveAddressDiv" class="manage-right2" >
				<div class="manage-left" id="manage-left">编辑收货地址</div>
					<form  method="post" action="{{asset('home/show/save')}}">
					{{csrf_field()}}
						
					<input type="hidden" id="addressid" name="id" value={{$pdoid}} />
					<div id="consignee_addr" class="hide"  >
						
						<table width="700" height="150" border="0" cellspacing="0">
							<tr>
								<td width="100" align="left" style="color:#83847e"><font style="color:red">*</font>&nbsp;评论的商品</td>
								<td width="250" align="left" class="cor-2">
									{{$arr['name']}}
								</td>

								<td width="150"></td>
								<td width="200"></td>
							</tr>
							<tr>
								<td align="left" style="color:#83847e;"><font style="color:red">*</font>&nbsp;商品图</td>
								<td align="left" class="cor-2"><img src="{{$arr['image']}}" alt=""  width="200px"/>
								</td>
							</tr>		
							
							
							<tr><td width="200" style="color:#83847e;"><font style="color:red"></font>&nbsp;</td>
								<td><textarea class="" rows="3"  placeholder="输入您的意见" name="text" style="width:400px;"></textarea></td>
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
                 <div class="save" style="margin-right: 650px"><input type="submit"  style="width: 100px;height: 30px;border:0;cursor: pointer;"/></div>					
				<div class="clear"></div>				
				{{csrf_field()}}
					</form>
					@if(Session::has('message'))
				<span style="color:red;font-size: 18px;height:30px;line-height: 30px">{{Session::get('message')}}</span>
			@endif
			</div>
			  	
		  	</div>
		  	</div>
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

									 
									

</script>
<!-- <script type="text/javascript" src="http://www.roseonly.com.cn/assets/jquery/Base.js"></script> -->
</body>
</html>