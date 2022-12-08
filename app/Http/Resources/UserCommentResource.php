<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

class UserCommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $status = [Comment::ACCEPTED=>'Accepted',Comment::ADDED=>'Sent and in list of check comments',Comment::DELETEREQUEST=>"Doesn't approved by Restaurant"];
        return [
            'restaurant'=>$this->restaurant->name,
            'foods'=>[
                $this->order->foods->pluck('name')
            ],
            'created_at'=>$this->created_at,
            'score'=>$this->score,
            'content'=>$this->content,
            'answer'=>$this->whenNotNull($this->answer),
            'status'=>$status[$this->status]
        ];
    }
}
