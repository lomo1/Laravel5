<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('testApi', function () {
    return json_encode(array("error" => array("returnCode" => "0", "returnMessage" => "测试接口--testApi, Successful!"), "data" => null));
});

Route::get('user/{id}', 'laravelStudyTestController@showProfileJSON');


//测试demo

//增加
Route::get('student/add/{name}/{age}/{sex}', 'addStudentController@addStu');

//删除
Route::get('student/del/{id}', 'delStudentController@delStuById');

//查询
Route::get('student/queryAll', 'queryStudentController@queryStu');

Route::get('student/query/{name}', 'queryStudentController@queryStuByName');

//更新
Route::get('student/update/{id}/{newAge}', 'updateStudentController@updateStu');


/**
 * ORM 数据操作路由
 */

//查询
Route::get('ormQuery', 'queryStudentController@ormQuery');


//新增
Route::get('ormAdd', 'addStudentController@ormAdd');

//更新数据
Route::get('ormUpdate', 'updateStudentController@ormUpdate');


//删除数据
Route::get('ormDelete', 'delStudentController@ormDelete');