<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class updateStudentController extends Controller
{

    public function updateStu($id, $newAge)
    {
        $bool = DB::update('update student set age = ? where id = ?', [$newAge, $id]);
        var_dump($bool);
    }
}
