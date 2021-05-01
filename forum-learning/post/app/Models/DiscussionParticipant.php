<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscussionParticipant extends Model
{
    use HasFactory;

    protected $table = "discussion_participants";

    protected $fillable = ["user_id","discussion_id","created_at","updated_at"];
}
