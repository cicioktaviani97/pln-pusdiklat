<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'discussion';
    protected $fillable = [
        "id","forum_id","title", "zoom_invitation_url","zoom_host_email",
        "zoom_host_password","start_datetime","end_datetime","created_at",
        "updated_at","discussion_request_id","status","category_id"
    ];

    protected $dates = ['created_at','updated_at'];


    public function discussion_participant_relation()
    {
        return $this->hasMany(\App\Models\DiscussionParticipant::class, "discussion_id", "discussion_id");
    }
}
