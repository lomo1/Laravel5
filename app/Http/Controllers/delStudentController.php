<?php

namespace App\Http\Controllers;

use App\StudentModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class delStudentController extends Controller
{
    public function delStuById($id)
    {
        $res = DB::delete('delete from student where id = ?', [$id]);
        var_dump($res);


        //另一种写法
        //$res = DB::table('student')->where('id', '=', $id)->delete();
        //清空表
        //DB::table('student')->truncate(); //该操作不返回任何值
    }


    //模型ORM 删除数据
    public function ormDelete()
    {
        //模型删除
        //$s= StudentModel::find(16);
        //$r = $s->delete();
        //var_dump($r);


        //通过主键删除; 删除多个,则传一个数组
        //$s = StudentModel::destroy(100);
        ////$s = StudentModel::destroy([100,1001,2000]);
        //var_dump($s);

        //删除指定条件的数据
        $r = StudentModel::where('id', '>', '18')->delete();
        var_dump($r);
    }
}
