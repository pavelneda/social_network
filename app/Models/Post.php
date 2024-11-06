<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $guarded = false;

    protected $with = ['image'];

    public function image()
    {
        return $this->hasOne(PostImage::class, 'post_id', 'id')
            ->whereNot('status', '=', false);
    }
}
