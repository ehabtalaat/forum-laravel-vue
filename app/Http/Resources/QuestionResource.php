<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\Question;
use App\Http\Resources\ReplyResource;
class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'path' =>  $this->path,
            'slug' => $this->slug,
            'replies' =>  ReplyResource::collection($this->replies),
            'replies_count' => $this->replies->count(),
            'created_at' => $this->created_at->diffForHumans(),
            'user' => $this->user['name'],
            'category' => $this->category['name'],
            'body' => $this->body,
            'user_id' => $this->user_id
        ];
    }
}
