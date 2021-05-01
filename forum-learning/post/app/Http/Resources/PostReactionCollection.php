<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostReactionCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if (is_null($this->resource)) {
            return [];
        }

        return [
            "user_id"    => (int) $this->user_id,
            "post_id"    => (int) $this->posts_id,
            "up_vote"    => (int) $this->up_vote,
            "down_vote"  => (int) $this->down_vote,
            "agree"      => (int) $this->agree,
            "skeptic"    => (int) $this->skeptic,            
            "created_at" => ($this->created_at != null) ? $this->created_at->format("d-m-Y H: i: s"): "-",
            "updated_at" => ($this->updated_at != null) ? $this->updated_at->format("d-m-Y H:i:s"): "-"
        ];
    }
}
