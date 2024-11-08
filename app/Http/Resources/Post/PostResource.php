<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'image_url' => $this->image ? $this->image->url : null,
            'date' => $this->created_at->diffForHumans(),
            'user' => $this->user,
            'is_liked' => $this->is_liked ?? false,
            'likes_count' => $this->likedUsers()->count(),
        ];
    }
}
