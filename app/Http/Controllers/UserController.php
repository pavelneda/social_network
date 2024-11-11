<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\Post;
use App\Models\User;
use Inertia\Inertia;


class UserController extends Controller
{

    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();

        $followings = auth()->user()->followings()->get(['following_id'])->pluck('following_id')->toArray();

        foreach ($users as $user) {
            if (in_array($user->id, $followings))
                $user['is_follow'] = true;
        }

        return Inertia::render('User/Index', ['users' => UserResource::collection($users)]);
    }

    public function posts(User $user)
    {
        $posts = $this->postsIsLiked($user->posts()->withCount('repostedByPosts')->get());
        return Inertia::render('User/Show', ['posts' => PostResource::collection($posts), 'userName' => $user->name]);
    }

    public function feed()
    {

        $followingsIds = auth()->user()->followings()->pluck('following_id')->toArray();
        $likedPostsIds = auth()->user()->likedPosts()->pluck('id')->toArray();

        $posts = Post::whereIn('user_id', $followingsIds)
            ->whereNotIn('id', $likedPostsIds)->withCount('repostedByPosts')->latest()->get();

        return Inertia::render('User/Feed', ['posts' => PostResource::collection($posts)]);
    }

    public function follow(User $user)
    {
        $res = auth()->user()->followings()->toggle($user);
        $data['is_follow'] = count($res['attached']) > 0;

        return $data;
    }

    private function postsIsLiked($posts)
    {

        $likedPostsIds = auth()->user()->likedPosts()->pluck('id')->toArray();

        foreach ($posts as $post) {
            if (in_array($post->id, $likedPostsIds)) $post->is_liked = true;
        }

        return $posts;
    }

}
