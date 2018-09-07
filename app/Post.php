<?php

namespace App;

use App\Model;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Scout\Searchable;

//对应 数据库的posts表
class Post extends Model
{
    use Searchable;

    public function searchableAs()
    {
        return 'post';
    }

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content,
        ];
    }

    //关联用户
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //关联评论
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at', 'desc');
    }

    /**
     * 关联赞表[一篇文章一个用户只能有1个赞]
     * @param $user_id
     */
    public function zan($user_id)
    {
        return $this->hasOne('\App\Zan')->where('user_id', $user_id);
    }

    /**
     * 文章赞的数量
     */
    public function zans()
    {
        return $this->hasMany('\App\Zan');
    }

    /**
     * 文章属于某个作者
     */
    public function scopeAuthorBy(Builder $query, $user_id){
        return $query->where('user_id', $user_id);
    }

    /**
     * 文章有多少个专题
     */
    public function postTopics(){
        return $this->hasMany(\App\PostTopic::class, 'post_id', 'id');
    }

    /**
     * 不属于某个专题的文章
     * @param Builder $query
     * @param $user_id
     * @return mixed
     */
    public function scopeTopicNotBy(Builder $query, $topic_id){
        return $query->doesntHave('postTopics', 'and', function ($q) use ($topic_id){
            $q->where('topic_id', $topic_id);
        });
    }

    /**
     * 只展示未被删除的文章
     */
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope('avaiable', function (Builder $builder){
            $builder->whereIn('status', [0, 1]);
        });
    }


}