<?php

namespace App\Http\Controllers;

use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class addStudentController extends Controller
{

    public function addStu($name, $age, $sex)
    {
        $bool = DB::insert('insert into student(name, age, sex) values (?, ?, ?)',
            [$name, $age, $sex]);
        var_dump($bool);
    }


    //使用ORM 插入数据
    public function ormAdd()
    {
        //获得一个模型对象
        $student = new StudentModel();
        //dd($student); //打印模型属性

        //给模型属性赋值, 打印即可看到增加的属性
        //$student->name = 'lomoa';
        //$student->age = '18';
        //$student->height = "190";
        //dd($student);

        //保存属性入库,即 插入数据
        //$student->name = 'lomo15';
        //$student->age = '18';
        //$student->sex = '1';
        //$bool = $student->save();
        //var_dump($bool);

        //当在模型中开启$timestamps=true 并添加处理时间处理函数后, 此处可以直接获取对应格式的时间戳
        //$s = StudentModel::find(1);
        //echo data('Y-m-d H:i:s', $s->created_at); //输出年月日时分秒格式



        //使用create增加数据
        //$s = StudentModel::create(
        //    ['name' => 'lommmm', 'age' => '100', 'sex' => '0']
        //);
        //
        //dd($s);


        //firstOrCreate(), 以属性查找,没有则新增并获取新的实例; 当name值不在数据表里时, 注意:当其它列 如:age、sex在数据表创建时未设定默认值,则该方法会报错 , 提示其它列没有默认值 从而导致创建新用户失败
        //$s = StudentModel::firstOrCreate(['name' => 'lomo119']);
        //dd($s);

        //firstOrNew()
        //$s= StudentModel::firstOrNew(
        //    ['name' => 'lomo119']
        //);
        //$bool = $s->save(); //此时需要手动保存数据
        //dd($bool); //会发现保存失败, 原因同上, 其他列未设定默认值。



    }


}
