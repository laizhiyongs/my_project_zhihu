<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //粉丝用户[粉丝用户id与user_id一对一]
    public function fuser()
    {
        return $this->hasOne(\App\User::class, 'id', 'fan_id');
    }

    //被关注用户[被关注用户id与user_id一对一]
    public function suser()
    {
        return $this->hasOne(\App\User::class, 'id', 'star_id');
    }

}
