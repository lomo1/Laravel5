<?php

namespace App\Http\Controllers;

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

}
