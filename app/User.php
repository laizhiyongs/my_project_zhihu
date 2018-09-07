<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //允许注入的字段
    protected $fillable = ['name', 'email', 'password'];

    /**
     * 一个用户有那些文章
     */
    public function posts()
    {
        return self::hasMany(Post::class);
    }

    /**
     * 关注我的粉丝[一个用户可以有多个粉丝]
     */
    public function fans()
    {
        return self::hasMany(Fan::class, 'star_id', 'id');
    }

    /**
     * 我关注的人有那些
     */
    public function stars()
    {
        return self::hasMany(Fan::class, 'fan_id', 'id');
    }

    //我要关注某人
    public function doFan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        self::stars()->save($fan);
    }

    /**
     * 我要取消关注某人
     * @param int $uid
     */
    public function doUnfan($uid)
    {
        $fan = new Fan();
        $fan->star_id = $uid;
        self::stars()->delete($fan);
    }

    /**
     * 判断当前用户是否被某uid关注
     */
    public function hasFan($uid)
    {
        return self::fans()->where(['fan_id' => $uid])->count();
    }

    /**
     * 判断当前用户是否关注了某uid
     * @param int $uid
     */
    public function hasStar($uid)
    {
        return self::stars()->where(['star_id' => $uid])->count();
    }


}
