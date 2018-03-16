@extends('home.base')
@section('title','roseonly官网')
@section('js')
		<link href="{{asset('home/css/lanrenzhijia2.css')}}" type="text/css" rel="stylesheet">
		<link rel="stylesheet" href="{{asset('home/css/zmd.css')}}">
		<script type="text/javascript" src="{{asset('home/js/lanrenzhijia.js')}}"></script>
		<script type="text/javascript" src="{{asset('home/js/lanrenzhijia2.js')}}"></script>
@endsection
@section('content')
		<div class="lanrenzhijia">
			<div id="slider" class="lanrenzhijia2">
				@foreach($nav1 as $v)
				<img src="{{$v['image']}}" alt="" title="#lanrenzhijia1">
				@endforeach

			<div id="preloader"></div>
		</div>
		<div class="city">
	        <div class="sf">所在省份：
	            <select name="province" id="province" onchange="dong()">
	            <option value="0">全国</option>
	            @foreach($data as $v)
	            <option value="{{$v['id']}}">{{$v['name']}}</option>
	            @endforeach
	            </select>
	        </div>&nbsp;&nbsp;
	        <div class="cs">所在城市：
	            <select name="city" id="city">
	            	<option value="-1">请选择城市</option>
	            </select>
	        </div>
    	</div>
    	<div class="con_about_deliveryfont" id="did">
			@foreach($list as $v)
			<ul id="shopList" class="about_store0" style="">
			<li style="width:430px;float:left;margin-left: 50px;"> 
			<div class="about_deliveryfont_left"> 
				<div class="deliveryfont_word"> 
					<h1>{{$v['name']}}</h1>
					<span class="store_see" onclick="$('#store_map_0').show();change(this);initMap(0,116.461378,39.944589,{{$v['adress']}},'电话'{{$v['tel']}});" style="color:#414141;"> 
					<img src="http://www.roseonly.com.cn/userview/images/bt_03.png">
			 		</span> 
			 		<a href="javascript:void(0);" class="store_button" onclick="fun_show('1');">发送手机</a> 
				</div> 
				<ul> 
				<li>{{$v['adress']}}</li> 
				<li style="padding-top:10px">营业时间｜{{$v['time']}}</li>
				<li>电话｜{{$v['tel']}}</li> 
				</ul> 
			</div>
			</li>
			</ul>
			@endforeach
		</div>
		</div><!-- conter结束 -->
		<div class="main_view_line2"></div>
		<script>
		function dong(){
			//获取被选中的option标签
 		var vs = $('select option:selected').val();
 			$.get("city",{id:vs},function(data){
 				$("#city>option").hide();
				
 				for (var i = 0; i < data.length; i++) {
				cc = data[i]['name'];
				gg = data[i]['id'];
				// $("#city").length = 1;

				aa = $("<option>");
				aa.html(cc);
				aa.val(gg);

				$('#city').append(aa);
				}
 			})
		}
		$("#city").change(function (){
			var dd = $(this).val();
			// alert(dd);
			$(".about_store0").remove();
			$.get("dian",{id:dd},function(data){
 				for (var i = 0; i < data.length; i++) {
				var aa = "<ul id='shopList' class='about_store0'>"+
			"<li style='width:430px;float:left;margin-left: 50px;'>"+ 
			"<div class='about_deliveryfont_left'>"+ 
				"<div class='deliveryfont_word'>"+ 
					"<h1>"+data[i]['name']+"</h1>"+
					"<span class='store_see'>"+
					"<img src='http:www.roseonly.com.cn/userview/images/bt_03.png'>"+
			 		"</span> "+
			 		"<a href='javascript:void(0);' class='store_button'>发送手机</a>"+ 
				"</div> "+
				"<ul> "+
				"<li>"+data[i]['adress']+"</li>" +
				"<li style='padding-top:10px'>"+"营业时间｜"+data[i]['time']+"</li>"+
				"<li>"+"电话｜"+data[i]['tel']+"</li>"+ 
				"</ul> ";
				$('#did').append(aa);
				}
 			})
		})

		</script>
@endsection