<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

class laravelStudyTestController extends Controller
{
    //

    public function showProfileJSON($id) {
        return json_encode(array("error" => array("returnCode" => "02", "returnMessage" => "测试接口--user, Successful!"), "data" => "接收到的ID: ".$id));
    }
}
