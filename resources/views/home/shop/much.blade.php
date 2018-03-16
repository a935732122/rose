
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0 ,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>结算页面</title>

		<link href="{{asset('home/css/amazeui.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('home/css/demo.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('home/css/cartstyle.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{asset('home/css/jsstyle.css')}}" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="{{asset('home/js/address1.js')}}"></script>
		<link rel="stylesheet" href="{{asset('home/css/rose.css')}}">

		<script src = "{{asset('home/js/jquery.js')}}"></script>
		<script src = "{{asset('home/js/list.js')}}"></script>
		<script type="text/javascript" src="{{asset('home/js/gaoduan.js')}}"></script>
		
		
		<script type="text/javascript" src="{{asset('home/js/jquery-1.7.1.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('home/js/jquery.preloader.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('home/js/jquery.nivo.slider.pack.js')}}"></script>

	</head>

	<body>
	<div class="aheader">
			<div class ="logo">
				<div class ="logo1">
						<a href="{{asset('home/index')}}"><img src="{{asset('home/image/index.png')}}" alt="">
						<div id="logo1">
							<img src="{{asset('home/image/index2.png')}}" alt="">
						</div></a>
				</div>
				<div class ="logo2">
						<a href="{{asset('home/list/index/2')}}">
						<img src="{{asset('home/image/index1.png')}}" alt="" width="128px" height="35px">
						<div id="logo2">
							<img src="{{asset('home/image/index3.png')}}" alt="" width="128px" height="35px">
						</div></a>
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
						<span><a href="">注册</a></span>
							@endif
						</p>
					<p>
						<a href=""><img src="{{asset('home/image/shop.png')}}" alt="" width="20px" height="20px" style="width:20px;height:20px;margin-top: 0"></a>

						
					</p>
					<p>
						<span>(0)</span>
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
					<a href="" class="nav1_three">roseonly.</a>
				<ul>
					@foreach($nav2 as $v)
					<li>
					<a href="" class="nav1_two">{{$v['name']}}</a>
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
									<a href=""><span class="text2">{{$vm['name']}}</span>
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
						<span><a href="">注册</a></span>
							@endif
						</p>
						<p>
								<a href=""><img src="{{asset('/home/image/shop1.png')}}" alt="" width="20px" height="30px"></a>

								
						</p>
						<p>
								<span>(0)</span>
						</p>
				
					</div>
				</ul>
			</div>
		</div>
	

			<!--悬浮搜索框-->

			<div class="clear"></div>
			<div class="concent">
				<!--地址 -->
				<div class="paycont">
					<div class="address">
						<h3>确认收货地址 </h3>
						<div style="display: block;float: left;margin-left: 20px;margin-top: 10px;background: #DD514C;width:80px;height:30px;line-height: 30px;text-align: center;">
							<a href="{{asset('home/personal/address')}}" style="color:white">添加地址</a>
						</div>
						<div class="clear"></div>
						@if(Session::has('message'))
										<div style="color:red;margin-left:650px;margin-top: 50px;font-size: 30px">
									        {{Session::get('message')}}
									    </div>
									@endif
						<ul>
							
						@foreach($ss as $v)
							<div class="per-border"></div>
							<li class="user-addresslist"  name="{{$v['id']}}" onclick="ss(this)">
								<div class="address-left">
									<div class="user DefaultAddr">

										<span class="buy-address-detail">   
                   						<span class="buy-user">{{$v['name']}}</span>
										<span class="buy-phone">{{$v['phone']}}</span>
										@if($v['da']==1)
					                默认地址
					                @else
					                 <a href="{{asset('home/personal/ad')}}?id={{$v['id']}}" class="blue">设为默认地址</a>
					            
					                @endif
										</span>
									</div>
									<div class="default-address DefaultAddr">
										<span class="buy-line-title buy-line-title-type">收货地址：</span>
										<span class="buy--address-detail">
								   		<span class="province">{{$v['s_province']}}</span>省
										<span class="city">{{$v['s_city']}}</span>市
										<span class="dist">{{$v['s_county']}}</span>区
										<span class="street">{{$v['address']}}</span>
										</span>
									</div>
									
								</div>

								<div class="address-right">
									<a href="../person/address.html">
										<span class="am-icon-angle-right am-icon-lg"></span></a>
								</div>
								<div class="clear"></div>

								<div class="new-addr-btn">
									
									
								
							
									<a href="{{asset('/home/personal/del')}}/?id={{$v['id']}}" onclick="delClick(this);"><i class="am-icon-trash"></i>删除</a>
								</div>
							</li>
							@endforeach
						</ul>
						<script>
							function ss(obj){
								$ss=$(obj);
								ssid = $ss.attr('name');
								// alert(ssid);
								$('#addrid').val(ssid);
							}

						</script>
						<div class="clear"></div>
					</div>
					<!--物流 -->
					<div class="logistics">
						<h3>选择物流方式</h3>
						<ul class="op_express_delivery_hot">
							<li data-value="yuantong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -468px"></i>圆通<span></span></li>
							<li data-value="shentong" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -1008px"></i>申通<span></span></li>
							<li data-value="yunda" class="OP_LOG_BTN  "><i class="c-gap-right" style="background-position:0px -576px"></i>韵达<span></span></li>
							<li data-value="zhongtong" class="OP_LOG_BTN op_express_delivery_hot_last "><i class="c-gap-right" style="background-position:0px -324px"></i>中通<span></span></li>
							<li data-value="shunfeng" class="OP_LOG_BTN  op_express_delivery_hot_bottom"><i class="c-gap-right" style="background-position:0px -180px"></i>顺丰<span></span></li>
						</ul>
					</div>
					<div class="clear"></div>

					
					<div class="clear"></div>

					<!--订单 -->
					<div class="concent">
						<div id="payTable">
							
							</div>

							
							</tr>
							</div>
							<div class="clear"></div>
							<div class="pay-total">
						<!--留言-->
						
							<div class="clear"></div>
							</div>
							<!--含运费小计 -->
							

							<!--信息 -->
							<div class="order-go clearfix">
								<div class="pay-confirm clearfix">
									<div class="box">
										<div tabindex="0" id="holyshit267" class="realPay"><em class="t">实付款：</em>
											<span class="price g_price ">
                                    <span>¥</span> <em class="style-large-bold-red " id="J_ActualFee">{{$list[0]['much']}}</em>
											</span>
										</div>

				
									</div>

									<div id="holyshit269" class="submitOrder">
										<div class="go-btn-wrap">
											<form action="{{asset('home/shop/fukuan')}}">
												<input type="hidden" name = 'id' value = "{{$list[0]['id']}}"/>
												<input type="hidden" name = 'addrid' value = "" id = "addrid"/>
												<button  title="点击此按钮，提交订单" id="J_Go" tabindex="0" style= "width:100px;height:50px;background: #FF4200;border:0px;color:white">  提交订单</button>
											</form>
											
										</div>
									</div>
									<div class="clear"></div>
								</div>
							</div>
						</div>

						<div class="clear"></div>
					</div>
				</div>
				
			</div>
			<div class="theme-popover-mask"></div>
			<div class="theme-popover">

				<!--标题 -->
				<div class="am-cf am-padding">
					<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">新增地址</strong> / <small>Add address</small></div>
				</div>
				<hr/>

				<div class="am-u-md-12">
					<form class="am-form am-form-horizontal" method="post" action="{{asset('home/personal/save')}}">
					{{csrf_field()}}
						<div class="am-form-group">
							<label for="user-name" class="am-form-label">收货人</label>
							<div class="am-form-content">
								<input type="text" id="user-name" placeholder="收货人" name = "name">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">手机号码</label>
							<div class="am-form-content">
								<input id="user-phone" placeholder="手机号必填" type="text" name = "phone">
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-phone" class="am-form-label">所在地</label>
							<div class="am-form-content address">
								<span id="consignee_arae">
										 <!-- 省市三级联动 -->
									    <select id="s_province" name="s_province" >
									    	<option></option>
									        </select>
									    <select id="s_city" name="s_city">
									    </select>
									    <select id="s_county" name="s_county">
									    </select>
									  	  <script class="resources library" src="{{asset('home/js/area.js')}}" type="text/javascript"></script>

    

   										 <script type="text/javascript">_init_area();</script>
									</span>
							</div>
						</div>

						<div class="am-form-group">
							<label for="user-intro" class="am-form-label" n>详细地址</label>
							<div class="am-form-content">
								<textarea class="" rows="3" id="user-intro" placeholder="输入详细地址" ame="address"></textarea>
								<small>100字以内写出你的详细地址...</small>
							</div>
						</div>

						<div class="am-form-group theme-poptit">
							<div class="am-u-sm-9 am-u-sm-push-3">
								<div class="save" style="margin-right: 50px;float: left" ><input type="submit"  style="width: 100px;height: 30px;border:0;cursor: pointer;"/></div>
								<div class="am-btn am-btn-danger close" style = "float: left">取消</div>
							</div>
						</div>
					</form>
				</div>

			</div>

			
	

<script>
window.onload = function(){

     var ahnav1 = document.getElementById('nav');
          var ahnav2 = document.getElementById('nav1');
           // document.title=tops;
          window.onscroll=function(){
            // 浏览器兼容性 Firefox Chrome
                aa = window.navigator.userAgent;
                if(aa.match('Firefox')){
                  // tops = document.documentElement.scrollTop;
                  if(document.documentElement.scrollTop>160){
                      ahnav1.style.display = 'block';
                      ahnav1.style.marginTop = '-160px';
                  }
                  if(document.documentElement.scrollTop<160){
                      ahnav1.style.display = 'none';
                      ahnav1.style.marginTop = '160px';

                  }
                }else{
                  if(document.body.scrollTop>160){
                      ahnav1.style.display = 'block';
                      ahnav1.style.marginTop = '-160px';
                  }
                  if(document.body.scrollTop<160){
                      ahnav1.style.display = 'none';
                      ahnav1.style.marginTop = '160px';
                  }
                }
          }
}
</script>

