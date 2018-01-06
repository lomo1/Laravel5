<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    //关联该模型的表; 默认情况下为数据表名的复数(student->students); 此处手动指定表名!
    protected $table = 'student';

    //默认以id作为主键, 如果不是,则手动指定即可; ide会自动提示变量名(神奇吧~)
    protected $primaryKey = 'id';

    //因为数据表student的时间设置格式不是时间戳形式保存,所以此处需要设定其为FALSE 才可以进行插入数据操作,否则会失败。
    public $timestamps = false;

    //如果数据表设计时, 创建时间、更新时间,不是使用MySQL默认的记录函数的话,则可以在此处手动维护,将上边的$timestamps设置为true, 然后在此处添加一个时间处理函数即可。

    protected function getDateFormat()
    {
        //在controller中 自定义输出格式即可, 如:输出年月日时分秒格式
        return time();
    }


    protected function asDateTime($value)
    {
        //不格式化的数据->时间戳, 默认拿到的是Unix时间戳, 不做任何处理
        return $value;
    }

    //指定允许create批量增加数据的字段
    protected $fillable = ['name', 'age', 'sex'];

    //不允许批量添加数据的字段
    protected $guarded = [];
}
