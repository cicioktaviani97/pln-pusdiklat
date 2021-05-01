<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = [ 'title', 'discussion_id', 'author_user_id', 'category_id', 'privasi', 'articles', 'thumbnail'];
    protected $dates = ['created_at','updated_at'];

    public function discussion_relation(){
        return $this->belongsTo(\App\Models\Discussion::class, "discussion_id", "id");
    }

    public function category_relation(){
        return $this->belongsTo(\App\Models\Category::class, "category_id", "id");
    }

    public function user_relation(){
        return $this->belongsTo(\App\Models\User::class, "author_user_id", "id");
    }
}
