<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link href="/admin/static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="/admin/static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="/admin/lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<title>用户查看</title>
</head>
<body>




<div class="cl pd-20" style=" background-color:#5bacb6">
  <img class="avatar size-XL l" src="static/h-ui/images/user.png">
  <dl style="margin-left:80px; color:#fff">
    <dt><span class="f-18">{{$list['name']}}</span></dt>
    <dd class="pt-10 f-16" style="margin-left:0">角色:超级管理员</dd>
  </dl>
</div>
<div class="pd-20">
  <table class="table">
    <tbody>

      <tr>
        <th class="text-r">注册时间:</th>
        <td>{{$list['created_at']}}</td>
      </tr>
      <tr>
        <th class="text-r">修改时间:</th>
        <td>{{$list['updated_at']}}</td>
      </tr>

    </tbody>
  </table>
</div>





<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

</body>
</html>