<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/css/bootstrap.min.css')}}" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui/css/H-ui.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/H-ui.admin.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/lib/Hui-iconfont/1.0.8/iconfont.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/skin/default/skin.css')}}" id="skin" />
<link rel="stylesheet" type="text/css" href="{{asset('admin/static/h-ui.admin/css/style.css')}}" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<!--/meta 作为公共模版分离出去-->

<title>@yield('title')</title>
@section('head')
@show
</head>
<body>
<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="{{asset('admin/index/index')}}">Roseonly后台首页</a> 
    </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>{{session()->get('email')}}</li>
                    <li class="dropDown dropDown_hover"> <a href="javascript:;" onclick="member_shows('{{session()->get('email')}}','{{asset('/admin/index/info')}}','{{session()->get('email')}}','500','400')" class="dropDown_A">个人信息<i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="{{asset('/auth/logout')}}">退出</a></li>
                </ul>
            </li>

                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
</div>
</header>
<!--/_header 作为公共模版分离出去-->
@section('content')
@show
<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
    
    <div class="menu_dropdown bk_2">
      <dl id="menu-admin">
            <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/user')}}" title="用户管理">用户管理</a></li>
                    <li><a href="{{asset('admin/role')}}" title="角色管理">角色管理</a></li>
                    <li><a href="{{asset('admin/permission')}}" title="权限列表">权限列表</a></li>
        </ul>
    </dd>
</dl>
        <dl id="menu-article">
            <dt><i class="Hui-iconfont">&#xe616;</i>导航管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/category')}}" title="导航管理">导航管理</a></li>
                      <li><a href="{{asset('admin/cate_image')}}" title="导航图片">导航图片</a></li>
        </ul>
    </dd>
</dl>
        <dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe620;</i> 专卖店<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                <li><a href="{{asset('admin/dian')}}" title="地址管理">专卖店</a></li>
                    <li><a href="{{asset('admin/provice')}}" title="地址管理">地址中心</a></li>
        </ul>
    </dd>
</dl>
        <dl id="menu-product">
            <dt><i class="Hui-iconfont">&#xe613;</i> 轮播管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/banner')}}" title="产品管理">首页轮播管理</a></li>
                    <li><a href="{{asset('admin/banner1')}}" title="产品管理">轮播管理1</a></li> 

                    <li><a href="{{asset('admin/lastbanner')}}" title="产品管理">轮播管理2</a></li> 
        </ul>
    </dd>
</dl>
    <dl id="menu-comments">
            <dt><i class="Hui-iconfont">&#xe622;</i> 商品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/pdo')}}" title="评论列表">商品列表</a></li>
                    <li><a href="{{asset('admin/pdo_type')}}" title="商品类别">商品类别</a></li>
                    <li><a href="{{asset('admin/pdo_attr')}}" title="商品类别">商品属性</a></li>
                     <li><a href="{{asset('admin/pdo_image')}}" title="商品类别">商品图片</a></li>
        </ul>
    </dd>
</dl>
       <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/vip')}}" title="会员列表">会员列表</a></li>
                    <li><a href="{{asset('admin/vipical')}}" title="会员详情">会员详情</a></li>
                    <li><a href="{{asset('admin/cart')}}" title="等级管理">购物车</a></li>
                    <li><a href="{{asset('admin/indent')}}" title="积分管理">订单管理</a></li>
                    <li><a href="{{asset('admin/viptalk')}}" title="积分管理">评论管理</a></li>
        </ul>
    </dd>
</dl>
   
<dl id="menu-picture">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 商品热销<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="{{asset('admin/fourpic')}}" title="商品管理">热销中心</a></li>
        </ul>
    </dd>
</dl>

       <!--  <dl id="menu-member">
            <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="member-list.html" title="会员列表">会员列表</a></li>
                    <li><a href="member-del.html" title="删除的会员">删除的会员</a></li>
                    <li><a href="member-level.html" title="等级管理">等级管理</a></li>
                    <li><a href="member-scoreoperation.html" title="积分管理">积分管理</a></li>
                    <li><a href="member-record-browse.html" title="浏览记录">浏览记录</a></li>
                    <li><a href="member-record-download.html" title="下载记录">下载记录</a></li>
                    <li><a href="member-record-share.html" title="分享记录">分享记录</a></li>
        </ul>
    </dd>
</dl> -->
      
      <!--   <dl id="menu-tongji">
            <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="charts-1.html" title="折线图">折线图</a></li>
                    <li><a href="charts-2.html" title="时间轴折线图">时间轴折线图</a></li>
                    <li><a href="charts-3.html" title="区域图">区域图</a></li>
                    <li><a href="charts-4.html" title="柱状图">柱状图</a></li>
                    <li><a href="charts-5.html" title="饼状图">饼状图</a></li>
                    <li><a href="charts-6.html" title="3D柱状图">3D柱状图</a></li>
                    <li><a href="charts-7.html" title="3D饼状图">3D饼状图</a></li>
        </ul>
    </dd>
</dl> -->
      <!--   <dl id="menu-system">
            <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
            <dd>
                <ul>
                    <li><a href="system-base.html" title="系统设置">系统设置</a></li>
                    <li><a href="system-category.html" title="栏目管理">栏目管理</a></li>
                    <li><a href="system-data.html" title="数据字典">数据字典</a></li>
                    <li><a href="system-shielding.html" title="屏蔽词">屏蔽词</a></li>
                    <li><a href="system-log.html" title="系统日志">系统日志</a></li>
        </ul>
    </dd>
</dl> -->
</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->



<!--_footer 作为公共模版分离出去-->
<script type="text/javascript">
//下面用于图片上传预览功能
function setImagePreview(avalue) {
　　var docObj=document.getElementById("doc");
 
　　var imgObjPreview=document.getElementById("preview");
　　if(docObj.files &&docObj.files[0])
　　{
　　　　
 
　　　　//火狐7以上版本不能用上面的getAsDataURL()方式获取，需要一下方式
　　　　imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]);
　　}
　　else
　　{
　　　　//IE下，使用滤镜
　　　　docObj.select();
　　　　var imgSrc = document.selection.createRange().text;
　　　　var localImagId = document.getElementById("localImag");
　　　　//必须设置初始大小
　　　　l
　　　　//图片异常的捕捉，防止用户修改后缀来伪造图片
　　　　try{
　　　　　　localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)";
　　　　　　localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc;
　　　　}
　　　　catch(e)
　　　　{
　　　　　　alert("您上传的图片格式不正确，请重新选择!");
　　　　　　return false;
　　　　}
　　　　imgObjPreview.style.display = 'none';
　　　　document.selection.empty();
　　}
　　return true;
}
 
</script>
<script type="text/javascript" src="{{asset('admin/lib/jquery/1.9.1/jquery.min.js')}}"></script> 
<script type="text/javascript" src="{{asset('admin/lib/layer/2.4/layer.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/static/h-ui/js/H-ui.js')}}"></script> 
<script type="text/javascript" src="{{asset('admin/static/h-ui.admin/js/H-ui.admin.page.js')}}"></script> 
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">

</script>
<!--/请在上方写此页面业务相关的脚本-->

<!--此乃百度统计代码，请自行删除-->
<script>

function member_shows(title,url,email,w,h){
    layer_show(title,"{{asset('/admin/index/info')}}?email="+email,w,h);
}
</script>
@section('js')
@show
<!--/此乃百度统计代码，请自行删除-->
</body>
</html>