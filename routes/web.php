<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return '<h2>Hello Home!</h2>';
});

// 限定请求方式
Route::match(['get', 'post'], 'multiple', function () {
    return "multiple: only get/post request";
});

//不限定请求方式
Route::any('any', function (){
    return "any request method supported.";
});

Route::get('test', function () {
    return 'Hello, This is Route /test';
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


// 路由别名, 可以在控制器、模板中直接使用别名,防止该文件中的路由变化时哪些文件也需要去修改。
// 别名也可以在在route中最后加上`->name('别名')`; 别名是为了方便在blade视图模板中使用 以防后期uri变更而不需要修改
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


Route::get('testview', 'testViewController@testViews');