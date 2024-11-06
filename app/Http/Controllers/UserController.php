<?php

namespace App\Http\Controllers;

use App\Http\Resources\Post\PostResource;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Inertia\Inertia;


class UserController extends Controller
{

    public function index()
    {
        $users = User::whereNot('id', auth()->id())->get();
        return Inertia::render('User/Index', ['users' => UserResource::collection($users)]);
    }

    public function posts(User $user)
    {
        $posts = PostResource::collection($user->posts);
        return Inertia::render('User/Show', ['posts' => $posts]);
    }

}
