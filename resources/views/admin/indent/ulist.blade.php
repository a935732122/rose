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


      <table class="table table-border table-bordered table-bg table-hover table-sort">
          <thead>
            <tr class="text-c">
              <th width="80">ID</th>
              <th width="419">商品名称</th>  
              <th width= "419">单价</th>
              <th width="419">图片</th>
            </tr>
          </thead>
          <tbody>
          @foreach($listm as $v)
            
            <tr>
                <td>{{$v[0]['id']}}</td>
                <td>{{$v[0]['name']}}</td>
                <td>{{$v[0]['price']}}</td>

                <td><img src="{{$v[0]['image']}}" alt="" style="width:200px;"></td>
                
            </tr>

     @endforeach
          </tbody>
        </table>




<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/admin/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="/admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/admin/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/admin/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

</body>
</html>