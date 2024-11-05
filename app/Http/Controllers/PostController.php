<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PostController extends Controller
{
    public function create(){
        return Inertia::render('Post/Create');
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        return Redirect::route('post.create');
    }
}
