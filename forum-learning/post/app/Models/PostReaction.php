<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostReaction extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $primaryKey = 'posts_id';
    protected $table = 'posts_reactions';
    protected $fillable = [ 'user_id', 'posts_id', 'up_vote', 'down_vote', 'agree', 'skeptic'];
    protected $dates = ['created_at','updated_at'];
}
