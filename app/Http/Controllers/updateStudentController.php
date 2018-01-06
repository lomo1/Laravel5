<?php

namespace App\Http\Controllers;

use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateStudentController extends Controller
{

    public function updateStu($id, $newAge)
    {
        $bool = DB::update('update student set age = ? where id = ?', [$newAge, $id]);
        var_dump($bool);
    }


    //使用ORM 更新数据

    public function ormUpdate()
    {
        //通过模型 去更新数据
        //$s= StudentModel::find(9);
        //$s->name = "new_lool";
        //var_dump($s->save());

        //批量更新; 将id>13的所有人年龄改为20岁
        $num = StudentModel::where('id', '>', 13)->update(['age' => '20']);
        var_dump($num);
    }
}
