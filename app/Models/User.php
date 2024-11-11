<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id')->orderBy('created_at', 'desc');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'subscriber_followings', 'subscriber_id', 'following_id');
    }

    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscriber_followings', 'following_id', 'subscriber_id');
    }

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'liked_posts', 'user_id', 'post_id');
    }

    public function stats()
    {
        $stats = [];
        $postsIds = $this->posts()->pluck('id')->toArray();
        $stats['followings_count'] = $this->followings()->count();
        $stats['subscribers_count'] = $this->subscribers()->count();
        $stats['likes_count'] = LikedPost::whereIn('post_id', $postsIds)->count();
        $stats['posts_count'] = count($postsIds);

        return $stats;
    }

}
