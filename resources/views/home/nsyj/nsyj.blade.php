
@extends('home.base')
@section('title','roseonly官网')
@section('js')
<link rel="stylesheet" href="{{asset('home/css/nuoyanshijie.css')}}">
<script type="text/javascript" src="{{asset('home/js/lanrenzhijia.js')}}"></script>

@endsection
@section('content')

		<div class="conter">
			<img src="{{asset('home/image/nuoshi.jpg')}}" alt=""  >
			<div class="lanrenzhijia">
			
				<div id="slider" class="lanrenzhijia2" style="margin-left: 14%;">
				@foreach($nav1 as $v)
					<img src="{{$v['image']}}" alt="" title="#lanrenzhijia1" >
				@endforeach

				</div>
			<div id="preloader"></div>
			</div>
			<img src="{{asset('home/image/aswy.jpg')}}" alt="" style="">
		</div>
		<div class="gs">
			<a href="">
				<dl style="">
					<dt>
					<img src="{{asset('home/image/ppgs.jpg')}}" alt="" class="pic">
					</dt>
					<dd>
						<h3>品牌故事</h3>
						<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
					</dd>
					
				</dl>
			</a>
			<a href="">
			<dl>
				<dt>
				<img src="{{asset('home/image/ppgs.jpg')}}" alt="">
				</dt>
				<dd>
					<h3>品牌故事</h3>
					<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
				</dd>
			</dl>
			</a>
			<a href="">
			<dl>
				<dt>
				<img src="{{asset('home/image/ppgs.jpg')}}" alt="">
				</dt>
				<dd>
					<h3>品牌故事</h3>
					<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
				</dd>
			</dl>
			</a>
		</div>
		<div class="gs">
			<a href="">
				<dl style="">
					<dt>
					
					<img src="{{asset('home/image/ppgs.jpg')}}" alt="">
					</dt>
					<dd>
						<h3>品牌故事</h3>
						<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
					</dd>
					
				</dl>
			</a>
			<a href="">
			<dl>
				<dt>
				<img src="{{asset('home/image/ppgs.jpg')}}" alt="">
				</dt>
				<dd>
					<h3>品牌故事</h3>
					<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
				</dd>
			</dl>
			</a>
			<a href="">
			<dl>
				<dt>
				<img src="{{asset('home/image/ppgs.jpg')}}" alt="">
				</dt>
				<dd>
					<h3>品牌故事</h3>
					<p>以爱之名创立的玫瑰，愿你永远相信真爱。</p>
				</dd>
			</dl>
			</a>
		</div>
		<div class="main_view_line2"></div>
	
	<!-- 结束 -->
@endsection