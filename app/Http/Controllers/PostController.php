<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;
use App\Models\PostImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use function Symfony\Component\Translation\t;

class PostController extends Controller
{
    public function create()
    {
        return Inertia::render('Post/Create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $imageId = $data['image_id'];
        unset($data['image_id']);
        $data['user_id'] = auth()->id();

        try {
            DB::beginTransaction();
            $post = Post::create($data);
            $this->processImage($post, $imageId);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::route('post.create')->withErrors($exception->getMessage());
        }

        return Redirect::route('post.create');
    }

    private function processImage($post, $imageId)
    {
        if (isset($imageId)) {
            $image = PostImage::find($imageId);
            $image->update([
                'post_id' => $post->id,
                'status' => true,
            ]);
        }
    }
}
