<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class DiscussionCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        return [
            "id"                    => $this->id,
            "forum_id"              => $this->forum_id,
            "title"                 => $this->title,
            "zoom_invitation_url"   => $this->zoom_invitation_url,
            "zoom_host_email"       => $this->zoom_host_email,
            "zoom_host_password"    => $this->zoom_host_password,
            "start_datetime"        => $this->start_datetime,
            "end_datetime"          => $this->end_datetime,
            "created_at"            => $this->created_at,
            "updated_at"            => $this->updated_at,
            "discussion_request_id" => $this->discussion_request_id,
            "status"                => $this->status,
            "category_id"           => $this->category_id,
        ];
    }
}
