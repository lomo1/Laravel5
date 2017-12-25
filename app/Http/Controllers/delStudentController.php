<?php

namespace App\Http\Controllers;

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
}
