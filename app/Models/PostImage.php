<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_images';
    protected $guarded = false;

    public function getUrlAttribute(){
        return url('storage/'. $this->path);
    }
}
