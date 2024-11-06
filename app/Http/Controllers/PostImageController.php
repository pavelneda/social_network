<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostImage\StoreRequest;
use App\Http\Resources\PostImage\PostImageResource;
use App\Models\PostImage;
use Illuminate\Support\Facades\Redirect;
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

        return PostImageResource::make($image)->resolve();
    }

    public static function clearStorage()
    {
        $images = PostImage::where('user_id', auth()->id())
            ->where('status', '!=', true)
            ->get();

        foreach ($images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }
    }
}
