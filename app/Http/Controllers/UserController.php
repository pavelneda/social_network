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
            in_array($user->id, $followings) ? $user['is_follow'] = true : $user['is_follow'] = false;
        }

        return Inertia::render('User/Index', ['users' => UserResource::collection($users)]);
    }

    public function posts(User $user)
    {
        $posts = PostResource::collection($user->posts);
        return Inertia::render('User/Show', ['posts' => $posts]);
    }

    public function feed()
    {
        $followingsIds = auth()->user()->followings()->get(['following_id'])->pluck('following_id')->toArray();
        $posts = PostResource::collection(Post::whereIn('user_id', $followingsIds)->get());

        return Inertia::render('User/Feed', ['posts' => $posts]);
    }

    public function follow(User $user)
    {
        $res = auth()->user()->followings()->toggle($user);
        $data['is_follow'] = count($res['attached']) > 0;

        return $data;
    }

}
