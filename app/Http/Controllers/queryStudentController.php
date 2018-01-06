<?php

namespace App\Http\Controllers;

use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class queryStudentController extends Controller
{

    public function queryStu()
    {
        $stu = DB::select('select * from student');
        var_dump($stu);
    }

    public function queryStuByName($name)
    {
        $res = DB::select('select * from student where name = ?', [$name]);
        return json_encode($res);
    }


    //使用ORM 查询数据
    public function ormQuery()
    {
        //查询所有
        //$students = StudentModel::all(); //查询所有
        //dd($students);


        //查询某个, find语法, 查询一个不存在的返回null
        //$one= StudentModel::find(7);
        //dd($one);

        //使用get方法查询所有
        //$two = StudentModel::get();
        //dd($two);

        //另一种查询方式写法; 查询id>6的并按照年龄降序排序后的第一个结果。
        //$o = StudentModel::where('id', '>', '5')
        //    ->orderBy('age', 'desc')
        //    ->first();
        //dd($o);

        //Chunk用法, 查询2条数据;
        //StudentModel::chunk(2, function ($res) {
        //    dd($res);
        //});


        //聚合函数,
        //统计表 行数
        //$num = StudentModel::count();
        //echo($num);

        //查询某列的最大值, 平均值...
        //$max = StudentModel::max('age');
        //var_dump($max);
        //查询某个条件下的最大值; 使用查询构造器!!!
        $max = StudentModel::where('id', '<', '5')->max('age');
        var_dump($max);

    }



}
