# Laravel 学习笔记

## Install

> 推荐使用 `composer`的方式按照. `composer`属于PHP语言里的第三方包(插件库)的管理器; 类似于`NodeJS`里的的`npm`;

### composer Install

composer安装及简介, 参考:

`http://docs.phpcomposer.com/00-intro.html#Installation-*nix`



```bash
#install Laravel
composer global require "laravel/installer"

# config path ...

# create Project
laravel new laravelStudy

#
```

## Basic

### Project Structure

> 使用`laravel` 所创建的应用的项目结构:

```bash
.
├── app
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config
├── database
├── package.json
├── phpunit.xml
├── public
├── readme.md
├── resources
├── routes
├── server.php
├── storage
├── tests
├── vendor
├── webpack.mix.js
└── yarn.lock

10 directories, 9 files
```

#### 文件夹说明

1. `app/` 目录下即为 **我们的项目/应用核心代码**。

2. `bootstrap/`, 此`bootstrap` 非彼`Bootstrap`; 创建时生成的, 用于框架的启动和自动载入配置, 其下的cache文件夹包含框架生成的启动文件,用来提升性能。

3. `config/`, 包含应用所有配置文件

4. `database/`, 数据迁移、填充文件

5. `public/`, 前端控制器和资源文件(图片、JS、CSS3)

6. `resources/`, 前端视图文件、资源文件(JS、SASS、)

7. `routes/`, 所有路由定义, 
> web.php文件包含web中间件路由: 会话、CSRF、Cookie 加密等; 如果都是restful风格的API, 则路由定义在api.php中。


8. `storage/`, 编译过的blade模板, 文件缓存 ...

9. `test/`, 测试, 单元测试代码。

10. `vendor`, 第三方依赖

##### app目录解析

```bash
# tree -L 2
├── Console
│   └── Kernel.php
├── Exceptions
│   └── Handler.php
├── Http
│   ├── Controllers
│   ├── Kernel.php
│   └── Middleware
├── Providers
│   ├── AppServiceProvider.php
│   ├── AuthServiceProvider.php
│   ├── BroadcastServiceProvider.php
│   ├── EventServiceProvider.php
│   └── RouteServiceProvider.php
└── User.php

6 directories, 9 files
```
新项目创建完毕后, app目录即为上所示。

`Console/` 和 `Http` 目录提供进入应用的核心API, 不包含应用逻辑, 2种向应用发布命令的方式。 `Console/`目录包含了所有的Artisan命令, `Http`目录包含控制器controller、中间件、请求。

`Exception/`目录包含应用的异常处理器, 应用抛异常。

> app目录下的很多类可以用过命令生成,就是 `Artisan`命令, 使用帮助: `php artisan list make`

```bash
# php artisan list make

Laravel Framework 5.5.27

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
      --env[=ENV]       The environment the command should run under
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands for the "make" namespace:
  make:auth          Scaffold basic login and registration views and routes
  make:command       Create a new Artisan command
  make:controller    Create a new controller class
  make:event         Create a new event class
  make:exception     Create a new custom exception class
  make:factory       Create a new model factory
  make:job           Create a new job class
  make:listener      Create a new event listener class
  make:mail          Create a new email class
  make:middleware    Create a new middleware class
  make:migration     Create a new migration file
  make:model         Create a new Eloquent model class
  make:notification  Create a new notification class
  make:policy        Create a new policy class
  make:provider      Create a new service provider class
  make:request       Create a new form request class
  make:resource      Create a new resource
  make:rule          Create a new validation rule
  make:seeder        Create a new seeder class
  make:test          Create a new test class
```



#### 根目录文件

> 项目根目录下文件

1. `.evn`, 直接参考此处: https://docs.golaravel.com/docs/5.0/configuration/#environment-configuration, 该文件不应被提交到git

2. `.env.example`, 

3. `artisan`, 

4. `composer.json`, 类似npm的`package.json`

5. `.gitignore`, ignore文件,不被git track 和 control; `.gitattributes`, 属性配置 便于github等系统识别该项目主要语言。

6. `server.php`, 

7. `yarn.lock`, yarn相关配置, 类似于node项目install后根目录下的那个`xxx-lock`文件。


## Usage

> 准备开始体验Laravel

当前版本信息:

```json
"laravel/framework": "5.5.*"
```

```
laravel -version
Laravel Installer 1.5.0

php artisan -version
Laravel Framework 5.5.27
```


### 配置

#### 基本环境配置
通过 laravel new xx 生成后, 进行基本的简单配置, 时区、语言等等

`/laravelStudy/config/`下的 `app.php`, `APP_DEBUG` 在本地开发环境时可以修改为`true`UTC, **线上环境坚决为FALSE**

`timezone` 由 `UTC` => `PRC` ,北京时区.


#### 数据库配置

`/laravelStudy/config/database.php`, `mysql` 数组, 在这里修改吗? 错错错!!!

Laravel 高版本, 起码我现在用的这个5.5版本 通过composer安装时,项目根目录下生产了一个`.evn`文件,该文件里有一些通用的配置, 且该配置里的所有信息都会存在一个`$_ENV`的超级全局变量内。
> 官方文档有说明

修改 项目根目录下 `.env`文件里的
```
DB_DATABASE=laravelStudy
DB_USERNAME=root
DB_PASSWORD=你的密码
```


### 开始搞接口

```
# 开启运行
php artisan serve
```

项目根目录下:

使用`artisan`命令创建控制器。语法: `controller:make 控制器名`;


创建一个resource类型的控制器
```bash
php artisan make:controller laravelStudyTestController
# 生成
```

该命令创建的控制器位于 `/laravelStudy/app/Http/Controllers/laravelStudyTestController.php`.

控制器创建完毕后, 添加路由, 让路由使用刚才创建的那个控制器去处理请求。路由就是一个HTTP 请求或 一个接口请求的URL地址。

所有的路由都在`routes/`文件夹中配置。

`routes/web.php` => web应用

```php
Route::get('test', function () {
    return 'Hello, This is Route /test';
});
```
浏览器打开:
http://127.0.0.1:8000/test, 即可看到结果。

接口:
`api.php`中配置路由:

```php
Route::get('testApi', function () {
    return json_encode(array("error" => array("returnCode" => "0", "returnMessage" => "测试接口--testApi, Successful!"), "data" => null));
});
```
http://127.0.0.1:8000/api/testApi


配置可以携带参数的:

```php
Route::get('user/{id}', 'laravelStudyTestController@showProfileJSON');

```

controller:
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class laravelStudyTestController extends Controller
{
    public function showProfileJSON($id) {
        return json_encode(array("error" => array("returnCode" => "02", "returnMessage" => "测试接口--testApi, Successful!"), "data" => "接收到的ID: ".$id));
    }
}

```

测试:
浏览器打开:
http://localhost:8000/api/user/sdfsdfsdf%E6%B0%B4%E7%94%B5%E8%B4%B9123

返回:
```json
{
    "error": {
        "returnCode": "02",
        "returnMessage": "测试接口--user, Successful!"
    },
  "data": "接收到的ID: sdfsdfsdf水电费123"
}
```






