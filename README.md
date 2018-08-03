# SINSER-PHP-SDK
点击 [此处](http://sinser.applinzi.com/) 前往迅析官网


## 环境准备
*   PHP 5.3+
    您可以通过`php -v`命令查看当前的PHP版本。

*   cURL 扩展
    您可以通过`php -m`命令查看cURL扩展是否已经安装好。
	
> **说明：**
> 
> *   Ubuntu系统中，您可以使用apt-get包管理器安装PHP的cURL扩展 `sudo apt-get install php-curl`。
> *   CentOS系统中，您可以使用yum包管理器安装PHP的cURL扩展 `sudo yum install php-curl`。

### SDK 安装
有两种方式安装SDK：
* Composer方式
* 源码方式

#### 1、Composer方式
推荐用户使用 Composer 安装 Sinser-PHP-SDK，Composer是PHP的依赖管理工具，允许您声明项目所需的依赖，然后自动将它们安装到您的项目中。

使用 Composer 安装 Sinser-PHP-SDK 十分简单，只需将此行添加到您的composer.json文件中：

```
 "isinser/sinser-php-sdk": ">=1.0.0"
```

或者执行以下代码
```
composer require isinser/sinser-php-sdk
```
请注意，vendor文件夹和vendor/autoload.php脚本由Composer生成;，它们不是Sinser-php-sdk的一部分。若您不选择Composer方式获取SDK，需要手动引入类，这一点在下文源码方式中有详细讲解。

#### 1、源码方式
源码方式安装SDK的步骤如下：

1.  在[github发布页面](https://github.com/iSinser/sinser-php-sdk)下载相应的zip文件

2.  解压zip文件得到整个SDK文件夹（我们将文件夹名定为sinser-php-sdk）

3.  将整个sinser-php-sdk文件夹移置于你的项目根目录中，并手动添加类文件
```
require '/sinser-php-sdk/src/main.php';
```

## 快速入门 
可参照Demo程序，详见 [example.php](https://github.com/iSinser/sinser-php-sdk/blob/master/example.php)

### 配置参数
```
$user = '';//ID 即登录帐号 需改动
$ak = '';//SID 需改动
$sk = '';//SecretKey 需改动
```
### 生成签名
```
$Authorization = $sinser -> getAuthorization($user,$ak,$sk,$sign_time,$salt);
```
### 发起统计
```
$ret = $sinser -> statistics($ak,$Authorization);
```
### 查询数据
```
$ret = $sinser -> getdata($ak,$sk,$type);
```
方法getdata()的参数三填写规则详解：
若$type=='json'，则将所有数据以json格式全部返回。
若$type=='1'(可选值1~13)，则返回单项数据。

具体参数对应值与返回数据对应值可查阅 [迅析API文档 - 查询接口](https://www.kancloud.cn/aipaiteam/sinser/711067)


至此，迅析SDK安装并调用完成。
