<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'about' => $this->about,
            'author' => $this->user->name,
            'view' => $this->view,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'comment' => [
                'link' => route('comments.index', $this->id)
            ]
        ];
    }
}
