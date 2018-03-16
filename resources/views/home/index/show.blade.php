@extends('home.base')
@section('title','roseonly官网')
@section('js')

<link rel="stylesheet" href="{{asset('home/css/list1.css')}}">
<link rel="stylesheet" href="{{asset('home/css/she.css')}}">
@endsection
@section('content')
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
	<div class="constrll">
		<div class="strll_te">
			<div class="sagi">
				<div class="sagi_widow">
					<div class="strll_img">
						<img src="{{$listi[0]['image']}}" alt="" class="ima_one" id="ima">
					</div>
				</div>
				<div class="bo_img">
					<div class="zuo"></div>
					@foreach($listi as $v)
					<a href="javascript:void(0);"><img src="{{$v['image']}}" onclick="huan(this)"></a>
					@endforeach
					<div class="you"></div>
				</div>
			</div>
			<div class="sagi_right">
				<div class="right_tit">{{$listp['name']}}</div>
				<div class="right_pay">
					<span>价格：</span>
					￥{{$listp['price']}}
				</div>
				
				<div class="shu">
					<span>数量：</span>
					<input type="text" value="1" class="number" maxlength="2" id="shu">
					<div class="shu_j" id="jia" style="cursor:pointer;">+</div>
					<div class="shu_jian" id="jian" style="cursor:pointer;">-</div>
				</div>
				<div class="liji">
					<a href="javascript:void(0);" class="mai" id="mai">立即购买</a>
					<a href="javascript:void(0);" class="che" id="che">加入购物车</a>
				</div>
		
					<p class="cheng">服务承诺：官方正品   免邮配送   同城速递</p>
		
				</div>
				<div class="clear"></div>

				<!-- 产品参数 -->
				<div class="can">
					<h1>产品参数</h1>
					@foreach($lista as $l)
					<div class="canl">
						<p>
							<b>{{$l["attr"]}}：</b>
								@foreach($listv as $v)
								@if($v['attr_id']==$l['id'])
								<span>{{$v['value']}}</span>
								@endif
								@endforeach
						</p>
					</div>
					@endforeach
				</div>

				<div style="margin-bottom:20px">
				
					<div style="font-size: 18px;float: left;margin-right: 20px"><a href="{{asset('home/show/index')}}/{{$listi[0]['pdo_id']}}">商品详情</a></div>
					<div style="font-size: 18px;float: left"><a href="{{asset('home/show/talk')}}/{{$listi[0]['pdo_id']}}">商品评论</a></div>
				</div>
				@foreach($listim as $v)
				<div class="xiang">
					<div class="xiang_img">
						<img src="{{$v['image']}}" alt="">
					</div>
				</div>
				@endforeach
	<!-- 结束 -->
		
	<!-- 页脚 -->
	<script type="text/javascript" src="jQuery.js"></script> 
	<script>
	function huan(btn) {
			var $li = $(btn);
			var ii = $li.attr("src");
			$("#ima").attr("src",ii);
		}
	$(function(){
		$("#jia").click(function(){
			var shu = $("#shu").val();
			shu ++;
			$("#shu").val(shu);
		});
		$("#jian").click(function(){
			var shu = $("#shu").val();
			if (shu==1) {
				return;
			}
			shu --;
			$("#shu").val(shu);
		});
		$("#che").click(function (){
			var num = $("#shu").val();
			window.location.href="{{asset('home/show/che')}}/{{$listp['id']}}/"+num;
		});
		$("#mai").click(function (){
			var num = $("#shu").val();
			window.location.href="{{asset('home/show/mai')}}/{{$listp['id']}}/"+num;
		});	
	})

	</script>

@endsection