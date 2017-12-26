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

> app目录下的很多类可以用过命令生成,就是 `Artisan`命令, 使用帮助: `php artisan list make`; `artisan`是Laravel框架内置命令行接口工具, 提供了一些列命令方便应用程序开发。

`php artisan --version` 查看当前 `Laravel` 框架版本号.


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

2. `.env.example`, `.env`的示例文件, 其中`APP_DEBUG`只能在本地dev开发环境中设置为true!!! **prod一定要设置为FALSE**, 切记!!!

3. `artisan`, laravel提供的命令行工具

4. `composer.json`, 类似npm的`package.json`

5. `.gitignore`, ignore文件,不被git track 和 control; `.gitattributes`, 属性配置 便于github等系统识别该项目主要语言。

6. `server.php`, 模拟服务器的rewrite功能

7. `yarn.lock`, yarn相关配置, 类似于node项目install后根目录下的那个`xxx-lock`文件。

8. `_ide_helper.php`, 安装插件后产生的IDE帮助文件类


> 很多项目环境变量设置直接在`.env`文件中设置 如: `APP_DEBUG`字段, `/config/app.php`中设置不起作用!


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

#### Mac开发环境配置

> 本地使用Apache加载PHP解析模块的方式(非php-fpm), 需要对Apache做以下修改:

```
#apache
cd ~
vim /etc/apache2/httpd.conf

# 1.找到.htaccess, 将 AllowOverride None 改为: AllowOverride all

# 2. 将#LoadModule rewrite_module modules/mod_rewrite.so 前的#井号去掉, 重启Apache即可。
```

本地访问:
`http://localhost/sites/laravelStudy/public/test`, 正常。(web.php里的路由)

`http://localhost/sites/laravelStudy/public/api/testApi`, 正常。(api.php里的路由)

`http://localhost/sites/laravelStudy/public/api/student/queryAll`, OK, 哈哈。


#### CentOS 6.5

> 在远程虚拟服务器centos6.5上也安装如上配置后,发现访问的是404.

继续修改服务器Apache的配置文件:
```
vim /etc/httpd/conf/httpd.conf
```
由于本服务器上设置的站点目录为: `/data/website/`, 所以先找到该关键字, 再找到下方的`AllowOverride`, 并将`none`改为all。 如下。

```
<Directory />
    Options FollowSymLinks
    AllowOverride all
</Directory>
```
测试:

http://client-qatools.jdb-dev.com/laravela/public/home, 正常。 (基于web.php的路由)

http://client-qatools.jdb-dev.com/laravela/public/users/lomo, 显示正常。


http://client-qatools.jdb-dev.com/laravela/public/api/testApi, 正常。(基于api.php的路由)


总结:
> Rewirte主要的功能就是实现URL的跳转和隐藏真实地址，基于Perl语言的正则表达式规范。平时帮助我们实现拟静态，拟目录，域名跳转，防止盗链等


#### 维护模式

`php artisan down`, 开启维护模式,访问该应用任何页面或接口 均提示 `Be right back.`。

与之对应的: `php artisan up`, 启动正常服务。


#### IDE插件配置

> https://github.com/barryvdh/laravel-ide-helper

```
#install
composer require barryvdh/laravel-ide-helper

#在 config/app.php 添加以下内容到 providers 数组
Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class,

#运行以下命令生成代码对应文档
php artisan ide-helper:generate

# 添加ignore `.gitignore`中, 该配置可能只是当前开发者IDE所需
.idea
_ide_helper.php
_ide_helper_models.php
.phpstorm.meta.php
```

中文参考: https://laravel-china.org/topics/2532/extended-recommendation-laravel-ide-helper-efficient-ide-smart-tips-plugin



#### Nginx

Nginx配置:
```
server{
    listen 8000;
    server_name localhost;
}
```

#### 基本环境配置
通过 laravel new xx 生成后, 进行基本的简单配置, 时区、语言等等

`/laravelStudy/config/`下的 `app.php`, `APP_DEBUG` 在本地开发环境时可以修改为`true`UTC, **线上环境坚决为FALSE**

`timezone` 由 `UTC` => `PRC` ,北京时区.



#### 数据库配置

`/laravelStudy/config/database.php`, `mysql` 数组, 在这里修改吗? 错错错!!!

Laravel 高版本, 起码我现在用的这个5.5版本 通过composer安装时,项目根目录下生产了一个`.evn`文件,该文件里有一些通用的配置, 且该配置里的所有信息都会存在一个`$_ENV`的超级全局变量内。
> 官方文档有说明

修改 项目根目录下 `.env`文件:

```php
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

#### 本地站点共享到公网

> 在项目根目录下 运行 `valet share`即可看到公网URL生成。

当我们在浏览器中访问URL: http://5f27a60f.ngrok.io/api/user/123a 会在本地终端中看到基本的请求信息。


依赖valet组件, valet安装步骤如下:

1. brew update

2. composer global require laravel/valet

3. valet install #该命令会自动停止nginx然后按照一些nginx配置、php71（如果没安装）

测试:

xxx.dev 在本地均可以ping通。

升级:

composer global update

valet install

Valet常用命令:

park、start、stop、restart、uninstall、path

> park命令会将执行当前命令所在的目录当做Web根目录。



本地开发, 建议直接使用 `php artisan serve` 启动8000端口的一个服务方便。 其它已安装的Apache、Nginx都不需要改动。


### 框架基本

> /routes/web.php

```php
// 限定请求方式
Route::match(['get', 'post'], 'multiple', function () {
    return "multiple: only get/post request";
});

//不限定请求方式
Route::any('any', function (){
    return "any request method supported.";
});

//携带参数
Route::get('user/{id}', function ($id) {
    return 'Hello '.$id;
});

//可选参数 optional params, default => lomo
Route::get('users/{name?}', function ($name = 'lomo') {
    return 'Hello '.$name;
});

//表达式限制
Route::get('usera/{age?}', function ($age = '0') {
    return 'User Age = '.$age;
})->where('age', '[0-9]{0,3}');


//路由别名, 可以在控制器、模板中直接使用别名,防止该文件中的路由变化时哪些文件也需要去修改。
Route::get('user/user-center', ['as' => 'userCenter', function() {
    return route('userCenter');
}]);


// 路由群组, 前缀
// http://127.0.0.1:8000/member/usera/123
// http://127.0.0.1:8000/member/users/123
Route::group(['prefix' => 'member'], function () {

    Route::get('usera/{age?}', function ($age = '0') {
        return 'member-User Age = '.$age;
    })->where('age', '[0-9]{0,3}');

    Route::get('users/{name?}', function ($name = 'lomo') {
        return 'Hello member-'.$name;
    });

});
```


### 视图(V)

> 视图以及视图中的变量

resource/views/下, 新建一个视图文件: testView.blade.php
```php
<?php
echo "Test View....<br>";
echo "Name: ". $name. " Age: ". $age;
```

app/Http/Controllers/下,新建控制器: testViewController
```php
<?php

namespace  App\Http\Controllers;

    class testViewController extends Controller {

        public function testViews() {
            return view('testView', [
                'name' => 'Lomo',
                'age' => '20'
            ]);
        }
    }
```

配置路由, /routes/web.php

```php
Route::get('testview', 'testViewController@testViews');
```

测试:

http://127.0.0.1:8000/testview

ok, 一切正常。


### 模型(M)

新建模型 `php artisan make testViewModel` ,在app/下创建了model文件。但是在controller中调用时发现始终报错!


尝试 `composer dump-autoload` 后依然报错,说 `Class 'app\testViewModel' not found`
> 注意: view 模板里的变量一定要和controller传的保持一致,否则就报此错误!!!



### DB操作

> 先创建一个数据库名为`laravelStudy`, 再在其中创建一个表: `student`, 表结构如下

```
USE `laravelStudy`;

CREATE TABLE IF NOT EXISTS `student` (
    `id` int(8) NOT NULL AUTO_INCREMENT,
    `name` varchar(20) NOT NULL COMMENT '姓名',
    `age` int(8) NOT NULL COMMENT '年龄',
    `sex` int(2) COMMENT '行性别,0->male,1-female',
    `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
    `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
    PRIMARY KEY (`id`),
    UNIQUE KEY `descDate` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='介绍-partOne' AUTO_INCREMENT=1 ;
```

> `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP, ON UPDATE 会在数据发生更新时 数据库自动更新该字段值。


通过浏览器Get请求接口增删改查数据demo:

增加数据:

路由配置:

`/routes/api.php`:
```php

```

控制器生成: `php artisan make:controller xxxController`, 注意: 使用命令创建时 api.php里的空的路由要先注释掉 否则报错。



访问:

查询所有的结果:
http://127.0.0.1:8000/api/student/queryAll, 或 `http://localhost/sites/laravelStudy/public/api/student/queryAll`

查询某一个:
http://127.0.0.1:8000/api/student/query/lomo


添加:
http://127.0.0.1:8000/api/student/add/lomo2/23/0, 若果使用`php artisan serve`内置服务访问

使用系统配置的服务器访问: http://localhost/sites/laravelStudy/public/api/student/add/lomo111/23/0

更新:
http://127.0.0.1:8000/api/student/update/1/26

删除:
http://127.0.0.1:8000/api/student/del/9

> DB::table('表名')->truncate(); //该操作不返回任何值, 谨慎!














