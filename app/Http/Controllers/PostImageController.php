<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImage\StoreRequest;
use App\Http\Resources\PostImage\PostImageResource;
use App\Models\PostImage;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class PostImageController extends Controller
{
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $path = Storage::disk('public')->putFile('images', $data['image']);
        $image = PostImage::create([
            'path' => $path,
            'user_id' => auth()->id(),
        ]);

        return Inertia::render('post.create', ['image' => PostImageResource::make($image)]);
    }
}
