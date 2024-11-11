<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = false;

    protected $with = ['image', 'user:id,name', 'likedUsers', 'repostedPost'];
    protected $withCount = ['comments'];

    public function image()
    {
        return $this->hasOne(PostImage::class, 'post_id', 'id')
            ->whereNot('status', '=', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likedUsers()
    {
        return $this->belongsToMany(User::class, 'liked_posts', 'post_id', 'user_id');
    }

    public function repostedPost()
    {
        return $this->belongsTo(Post::class, 'reposted_id', 'id');
    }

    public function repostedByPosts()
    {
        return $this->hasMany(Post::class, 'reposted_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

}
