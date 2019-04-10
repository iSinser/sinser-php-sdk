<?php 
require('sinser-php-sdk/src/main.php'); 

$sinser = new sinser;
$user = 'admin';//ID 即登录帐号 需改动
$ak = 'XUNXI71AtUrh4XpL0fuQ';//SID 需改动
$sk = 'oNwVPlMyJBcFwSxlLxIWjDMe';//SecretKey 需改动
$salt = rand('100000','999999');//盐值 无需改动
$sign_time = time();//签名时间戳 无需改动
$Authorization = $sinser -> getAuthorization($user,$ak,$sk,$sign_time,$salt);//生成签名

$ret = $sinser -> statistics($ak,$Authorization);//发送统计请求
print_r ($ret);
//单次签名有效期为30s 超时需重新生成


$ret = $sinser -> getdata(base64_encode($ak),sha1($sk));//获取统计数据
print_r ($ret);

//$ret = $sinser -> online($ak,$Authorization);//用户上线（已集成在统计接口中，该独立接口仅用于保持用户心跳，以达到用户长期在线）
//print_r ($ret);


?>

