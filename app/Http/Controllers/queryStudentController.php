<?php

namespace App\Http\Controllers;

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
}
