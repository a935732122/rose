
@extends('home.base')
@section('title','roseonly官网')
@section('js')
<link rel="stylesheet" href="{{asset('home/css/gaoduan.css')}}">
	<script type="text/javascript" src="{{asset('home/js/gaoduan.js')}}"></script>

@endsection
@section('content')
	<!-- <link rel="stylesheet" href="js/gaoduan.js"> -->
		
		
		<div class="banner">
			<a href=""><img src="{{asset('home/image/banner.jpg')}}"></a>
		</div>
		<div class="dingzhi">
			<img src="{{asset('home/image/2.jpg')}}" alt="">
			<img src="{{asset('home/image/3.jpg')}}" alt="">
			<img src="{{asset('home/image/4.jpg')}}" alt="">
			<img src="{{asset('home/image/5.jpg')}}" alt="">
		</div>
		<div class="quanshiai">
			<img src="{{asset('home/image/6.jpg')}}" alt="" class ="qsa">
			<div>
				<a href=""><img src="{{asset('home/image/7.jpg')}}" alt=""></a>
				<a href=""><img src="{{asset('home/image/8.jpg')}}" alt=""></a>
				<a href=""><img src="{{asset('home/image/9.jpg')}}" alt=""></a>
			</div>
			
		</div>
		<div class="pict">
			<img src="{{asset('home/image/10.jpg')}}" alt="">
			<img src="{{asset('home/image/11.jpg')}}" alt="">
			<img src="{{asset('home/image/12.jpg')}}" alt="">
			<img src="{{asset('home/image/13.jpg')}}" alt="">
			<img src="{{asset('home/image/14.jpg')}}" alt="">
		</div>
@endsection