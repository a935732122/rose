@extends('home.base')
@section('title','roseonly官网')
@section('js')
	<link rel="stylesheet" href="{{asset('home/css/she.css')}}">
<link rel="stylesheet" href="{{asset('home/css/carts.css')}}">
<link rel="stylesheet" href="{{asset('home/css/reset.css')}}">
@endsection
@section('content')
		
	@if(Session::has('message'))
										<div style="color:red;margin-left:650px;margin-top: 50px;font-size: 30px">
									        {{Session::get('message')}}
									    </div>
									@endif
<section class="cartMain">
	<div class="cartMain_hd">
		<ul class="order_lists cartTop" style="width:1000px;margin-left: 140px">
			<li class="list_chk">
				<!--所有商品全选-->
				<input type="checkbox" id="all" class="whole_check">
				<label for="all"></label>
				全选
			</li>
			<li class="list_con">商品信息</li>
		
			<li class="list_price">单价</li>
			<li class="list_amount">数量</li>
			<li class="list_amount">金额</li>
		
			<li class="list_op">操作</li>
		</ul>
	</div>

	<div class="cartBox" >
		<div class="shop_info">
			
			
		</div>
		<div class="order_content">
		@foreach($list as $v)
			<ul class="order_lists" style="width:1000px;margin-left: 120px">
				<li class="list_chk">
					<input type="checkbox" id="checkbox_{{$v[0]['id']}}" class="son_check" name = "id" value= "{{$v[0]['id']}}">		
					
					<label for="checkbox_{{$v[0]['id']}}"></label>
				</li>
				<li class="list_con">
			<div class="list_img"><a href="javascript:;"><img src="{{$v[0]['image']}}" alt=""></a></div>
					<div class="list_text"><a href="javascript:;">{{$v[0]['name']}}</a></div>
				</li>
				
				<li class="list_price">
					<p class="price">{{$v[0]['price']}}</p>
				</li>
				<li class="list_amount">
					<div class="amount_box">
					<input type="hidden" value="@foreach($lists as $l)@if($l['pdoid']==$v[0]['id']){{$l['id']}}@endif
@endforeach" id = "aa">
						<a href="javascript:;" class="reduce reSty">-</a>
						<input type="text" value="@foreach($lists as $l)@if($l['pdoid']==$v[0]['id']){{$l['num']}}@endif
@endforeach" class="sum" id = "num">
						<a href="javascript:;" class="plus" >+</a>
						<input type="hidden" value="@foreach($lists as $l)@if($l['pdoid']==$v[0]['id']){{$l['id']}}@endif
@endforeach" id = "aa">
					</div>
				</li>
				<li class="list_sum">
					<p class="sum_price">@foreach($lists as $l)@if($l['pdoid']==$v[0]['id']){{$l['num']*$v[0]['price']}}@endif
@endforeach
					</p>
				</li>
				<li class="list_op">
					<p class="del"><a href="{{asset('home/shop/del')}}/@foreach($lists as $l)@if($l['pdoid']==$v[0]['id']){{$l['id']}}@endif
@endforeach" class="delBtn">移除商品</a></p>
				</li>
			</ul>
		@endforeach
		</div>
	</div>


	<!--底部-->
	<div class="bar-wrapper">
		<div class="bar-right">
			<div class="piece">已选商品<strong class="piece_num">0</strong>件</div>
			<div class="totalMoney">共计: <strong class="total_text">0.00</strong></div>
			<div class="calBtn"><a href="javascript:;" id="jiesuan">结算</a></div>
		</div>
	</div>
</section>
<section class="model_bg"></section>
<section class="my_model">
	<p class="title">删除宝贝<span class="closeModel">X</span></p>
	<p>您确认要删除该宝贝吗？</p>
	<div class="opBtn"><a href="">确定</a><a href="javascript:;" class="dialog-close">关闭</a></div>
</section>
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

@endsection
