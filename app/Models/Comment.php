<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $guarded = false;

    protected $with = ['user:id,name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
