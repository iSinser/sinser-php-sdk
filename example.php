<?php 
require 'vendor/autoload.php';

$sinser = new sinser;
$user = '';//ID 即登录帐号 需改动
$ak = '';//SID 需改动
$sk = '';//SecretKey 需改动
$salt = rand('100000','999999');//盐值 无需改动
$sign_time = time();//签名时间戳 无需改动
$Authorization = $sinser -> getAuthorization($user,$ak,$sk,$sign_time,$salt);//生成签名

$ret = $sinser -> statistics($ak,$Authorization);//发送统计请求
print_r ($ret);
//单次签名有效期为20s 超时需重新生成


//getdata 参数说明
//第三个参数=json时 返回json格式数据
//第三个参数为1-13是 返回对应单个数据
$ret = $sinser -> getdata($ak,$sk,'json');//获取统计数据
print_r ($ret);


?>

