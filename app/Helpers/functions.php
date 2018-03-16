<?php

/**
  * 发送模板短信
  * @param to 手机号码集合,用英文逗号分开
  * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
  * @param $tempId 模板Id
  */       
function sendTemplateSMS($to,$datas,$tempId)
{

     //主帐号
	$accountSid= env('ACCOUNTSID','8a216da85f341b69015f474f738f0645');

	//主帐号Token
	$accountToken= '774424ec618f451fa76b8d3dbd027009';

	//应用Id
	$appId='8a216da85f341b69015f474f73f1064b';

	//请求地址，格式如下，不需要写https://
	$serverIP='app.cloopen.com';

	//请求端口 
	$serverPort='8883';

	//REST版本号
	$softVersion='2013-12-26';
     $rest = new Rest($serverIP,$serverPort,$softVersion);
     $rest->setAccount($accountSid,$accountToken);
     $rest->setAppId($appId);
    
     // 发送模板短信
     //echo "Sending TemplateSMS to $to <br/>";
     $result = $rest->sendTemplateSMS($to,$datas,$tempId);
     if($result == NULL ) {
         return false;
     }
     if($result->statusCode!=0) {
         // echo "error code :" . $result->statusCode . "<br>";
         // echo "error msg :" . $result->statusMsg . "<br>";
         //TODO 添加错误处理逻辑
        return false;
     }else{
         // echo "Sendind TemplateSMS success!<br/>";
         // // 获取返回信息
         // $smsmessage = $result->TemplateSMS;
         // echo "dateCreated:".$smsmessage->dateCreated."<br/>";
         // echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
         //TODO 添加成功处理逻辑
        return true;
     }
}






//echo "111";
// //Demo调用,参数填入正确后，放开注释可以调用 
// //sendTemplateSMS("手机号码","内容数据","模板Id");
// $resa = sendTemplateSMS($_POST['tel'],array("8888","123"),1);
// //echo $_POST['tel'];
// if($resa)
// {
//     echo "y";
// }
// else
// {
//     echo "n";
// }
/**
  * 发送模板短信
  * @param  filename 上传的文件
  * @param $filepath 存粗路径
  */      



