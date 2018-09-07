<?php
namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//对应 数据库的posts表
class Model extends BaseModel
{

    protected $guarded = [];  //不可以注入的字段,为空就是所有都可以


}
