<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = false;

    protected $with = ['user:id,name', 'parentComment'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parentComment()
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }
}
