# SINSER-PHP-SDK
迅析PHP SDK


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
推荐用户使用 Composer 安装 SINSER-PHP-SDK，Composer是PHP的依赖管理工具，允许您声明项目所需的依赖，然后自动将它们安装到您的项目中。

> **提示**：您可以在 [getcomposer.org](getcomposer.org) 上找到更多关于如何安装Composer，配置自动加载以及用于定义依赖项的其他最佳实践。
**使用 Composer 安装 SINSER-PHP-SDK**
1. 打开终端
2. 下载 Composer
```
curl -sS https://getcomposer.org/installer | php
```
3. 创建一个名为`composer.json`的文件，内容为
```
{
    "require": {
        "isinser/sinser-php-sdk": ">=1.0.0"
    }
}
```
4. 使用 Composer 安装
```
composer install
```
使用该命令后会在当前目录中创建一个vendor文件夹，里面包含 sdk 的依赖库和一个 autoload.php 脚本，方便用户在自己的项目中调用。
5. 通过 autoloader 脚本调用sinser-php-sdk-v5
```
require '/vendor/autoload.php';
```
现在您的项目已经可以使用 迅析 的SDK了。
