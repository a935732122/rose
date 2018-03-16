@extends('home.base')
@section('title','roseonly官网')
@section('js')
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{asset('home/css/list2.css')}}">
@endsection
@section('content')
		<center>
		<div class="content">
			<div>
				<img src="{{asset('/home/image/1.jpg')}}" alt="" class ="guang">
				<div class ="xuanze">
					<ul>
						<li><a href="{{asset('/home/list/index1')}}/{{$id}}"  style="margin-left: 0;margin-top: 0px;color:black">综合</a></li>
						<li>销量</li>
						<li><a href="{{asset('/home/list/new')}}/{{$id}}" style="margin-left: 0;margin-top: 0px;color:black">最新</a></li>
					</ul>
						<a style="color:black" href="{{asset('/home/list/price')}}/{{$id}}">价格降序<div></div></a><a style="color:black" href="{{asset('/home/list/price1')}}/{{$id}}">价格升序<div></div></a>
					
				</div>
				<ul class ="list">
					@foreach($list as $l)
					@foreach($l as $v)
					<li>
					   <div></div>
						<a href="{{asset('/home/show/index')}}/{{$v['id']}}"><img src="{{$v['image']}}" alt="" width="260px" height="260px"></a>
					<!-- 	<br> -->
						<p><b>{{$v['cateid']}}</b></p>
						<p class ="jieshao">{{$v['name']}}</p>
						<p><b>￥{{$v['price']}}</b></p>

					</li>
					@endforeach
					@endforeach
					
				</ul>
			
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
@endsection
