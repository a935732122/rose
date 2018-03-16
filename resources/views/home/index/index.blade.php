@extends('home.base')
@section('title','roseonly官网')
@section('js')
<script type="text/javascript" src="{{asset('home/js/lanrenzhijia.js')}}"></script>
@endsection
@section('content')
		<div class="lanrenzhijia">
			
			<div id="slider" class="lanrenzhijia2">
			@foreach($nav1 as $v)
				<img src="{{$v['image']}}" alt="" title="#lanrenzhijia1">
			@endforeach

			</div>
			

			<div id="preloader"></div>
		</div>
		<!-- 内容 -->
		<div class="new_conter">
			@foreach($ff as $v)
			<div class="new_con1">
				<div class="con_1" style="margin-right: 20px">
					<a href=""><img src="{{$v['image']}}"></a>
					<div class="con_1_text">{{$v['title']}}</div>
				</div>
			</div>
			@endforeach

			<div class="new_title">
				<p>热卖单品推荐</p>
			</div>
		<!-- 单品 -->
			<div class="danpin">
				<div class="dp_in">
					<div class="hotpic">
						
						<ul class="pic">
							@foreach($pp as $vm)
							<li>
								<a href="{{asset('home/show/index')}}/{{$vm['id']}}">
									<dl>
										<dt><img src="{{$vm['image']}}"></dt>
										<dd>
											<h3>{{$vm['name']}}</h3>
											<p>{{$vm['title']}}</p>
											<h2>￥{{$vm['price']}}</h2>
										</dd>
									</dl>
								</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>		
		
		<!-- 鲜花玫瑰 -->
		@foreach($cmss as $vx)
		@foreach($xx as $mx)
		@if($vx['cate_id']==$mx['id'])
		<div class="xhmg">
			<div class="xhmg_top">
				<div class="xhmg_top1" style="margin-left: 20px;">
					{{$mx['name']}}
					<span class="title_line"></span>
					<span class="title_fr">Fresh Cut Rose</span>
				</div>
			
				<div class="xhmg_mr"><a href="">MORE</a>
					<span class="mr_1"><img src="image/more.png"></span>
				</div>

				<div class="xhmg_nav" style="margin-left: 20px;">
					@foreach($cmss as $vm)
					@if($vm['cate_id']==$vx['cate_id'])
					<div class="xhmg_nav_j">
						<a href="">
						<img src="{{$vm['image']}}" >		

						<div class="xhmg_bg"></div>
						</a>
					</div>
					@endif
					@endforeach
					
					<div class="xhmg_nav_h">	
					@foreach($cms as $vn)
					@if($vn['cate_id']==$vx['cate_id'])
					<a href="" class="hjza">
					
					<img src="{{$vn['image']}}">
				
					<div class="xhmg_bg2"></div>
					</a>
						@endif
					@endforeach	
					</div>
					
				</div>

			</div>
	
		</div>
		@endif
		@endforeach
		@endforeach
		


		<div class="line1"></div>
	<!-- 专卖店 -->
		<div class="zmd">
			<a href="" class="zmd_left"><img src="image/zmd.jpg">
				<div class="bg3"></div>
			</a>
			<a href="" class="zmd_right"><img src="image/nuo.jpg">
				<div class="bg3"></div>
			</a>
		</div>
	<!-- 结束 -->
<script>
window.onload = function(){

	 // var oNew3 = document.getElementsByClassName('new3')[0];
  //     var nLi = oNew3.getElementsByTagName('div');
      
  //     // var nspan = document.getElementsByTagName('span');
  //     for(var i = 0;i<nLi.length;i++){
  //       nLi[i].onmouseover = function(){
  //         for(var j = 0;j<nLi.length;j++){
  //           nLi[j].nextElementSibling.style.display ='none';
  //           nLi[j].style.borderBottom = '';
  //           nLi[j].style.color = '';
  //         }
  //         this.nextElementSibling.style.display = 'block';
  //         this.style.borderBottom="5px solid #E7E7E7";    
  //     }
  //   }
        // xuaEle = document.getElementById('xua');
        // kaEle = xuaEle.getElementsByTagName('a');
        // for( i=0;i<kaEle.length;i++){
        //   kaEle[i].index=i;
        //   kaEle[i].onmouseover=function(){
        //     for(var j=0;j<kaEle.length;j++){
        //       kaEle[j].className="";
        //     }
        //     dongEle.style.left="-"+this.index*515+'px';
        //     this.className="current";
        //   }
        // }
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
