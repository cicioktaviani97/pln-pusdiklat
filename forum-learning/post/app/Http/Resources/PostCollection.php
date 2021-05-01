<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\CategoryCollection;
use App\Models\Category;

class PostCollection extends JsonResource
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
            "id"                => $this->id,
            "category_id"       => (int) $this->category_id,
            "discussion_id"     => (int) $this->discussion_id,
            "author_user_id"    => (int) $this->author_user_id,
            "title"             => $this->title,
            "articles"          => $this->articles,
            "privasi"           => $this->privasi,
            "thumbnail"         => ($this->thumbnail != null) ? asset(Storage::url($this->thumbnail)): '-',
            "created_at"        => ($this->created_at != null) ? $this->created_at->format("d-m-Y H:i:s") : "-",
            "updated_at"        => ($this->updated_at != null) ? $this->updated_at->format("d-m-Y H:i:s") : "-",
            "category_name"     => $this->category_relation->category_name,
            "discussion_tittle" => $this->discussion_relation->title,
            "author_name"       => $this->user_relation->full_name,
            "category"          => new CategoryCollection($this->category_relation),
            "discussion"        => new DiscussionCollection($this->discussion_relation)
        ];
    }
}
