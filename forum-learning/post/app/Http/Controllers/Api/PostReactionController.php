<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PostReaction;
use App\Http\Resources\PostReactionCollection;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostReactionRequest;

class PostReactionController extends Controller 
{
    public function index(){
        
        $post_reaction = PostReaction::all();

        return PostReactionCollection::collection($post_reaction)->additional([
            "status" => 200,
            "messsage" => "success"
        ]);
    }

    public function post_reaction($posts_id){
        $post_reaction = PostReaction::find($posts_id)->first();

        return (new PostReactionCollection($post_reaction))->additional([
            "status" => 200,
            "messsage" => "success"
        ]);
    }
    
    public function up_vote(Request $request)
    {
        $request->merge([
            "user_id" => Auth::user()->id,
        ]);

        if(PostReaction::where('user_id', '=', Auth::user()->id)->exists()){
            PostReaction::where('user_id', '=', Auth::user()->id)->update(array('up_vote' => '1'));
        }else{
            $post_reaction               = new PostReaction;
            $post_reaction->user_id      = Auth::user()->id;
            $post_reaction->posts_id     = $request->posts_id;
            $post_reaction->up_vote      = '1';
            $post_reaction->down_vote    = '0';
            $post_reaction->agree        = '0';
            $post_reaction->skeptic      = '0';
            $post_reaction->created_at   = Carbon::now();
            $post_reaction->save();
        }
        
        return response()->json([
            "data" => null,
            "status"  => 200,
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }
    public function down_vote(Request $request)
    {
        $request->merge([
            "author_user_id" => Auth::user()->id,
        ]);

        if(PostReaction::where('user_id', '=', Auth::user()->id)->exists()){
            PostReaction::where('user_id', '=', Auth::user()->id)->update(array('down_vote' => '1'));
        }else{
            $post_reaction               = new PostReaction;
            $post_reaction->user_id      = Auth::user()->id;
            $post_reaction->posts_id     = $request->posts_id;
            $post_reaction->up_vote      = '0';
            $post_reaction->down_vote    = '1';
            $post_reaction->agree        = '0';
            $post_reaction->skeptic      = '0';
            $post_reaction->created_at   = Carbon::now();
            $post_reaction->save();
        }

        return response()->json([
            "data" => null,
            "status"  => 200,
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }
    public function agree(Request $request)
    {
        $request->merge([
            "author_user_id" => Auth::user()->id,
        ]);
        
        if(PostReaction::where('user_id', '=', Auth::user()->id)->exists()){
            PostReaction::where('user_id', '=', Auth::user()->id)->update(array('agree' => '1'));
        }else{
            $post_reaction               = new PostReaction;
            $post_reaction->user_id      = Auth::user()->id;
            $post_reaction->posts_id     = $request->posts_id;
            $post_reaction->up_vote      = '0';
            $post_reaction->down_vote    = '0';
            $post_reaction->agree        = '1';
            $post_reaction->skeptic      = '0';
            $post_reaction->created_at   = Carbon::now();
            $post_reaction->save();
        }

        return response()->json([
            "data" => null,
            "status"  => 200,
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }
    public function skeptic(Request $request)
    {
        $request->merge([
            "author_user_id" => Auth::user()->id,
        ]);
        if(PostReaction::where('user_id', '=', Auth::user()->id)->exists()){
            PostReaction::where('user_id', '=', Auth::user()->id)->update(array('skeptic' => '1'));
        }else{
            $post_reaction             = new PostReaction;
            $post_reaction->user_id    = Auth::user()->id;
            $post_reaction->posts_id   = $request->posts_id;
            $post_reaction->up_vote    = '0';
            $post_reaction->down_vote  = '0';
            $post_reaction->agree      = '0';
            $post_reaction->skeptic    = '1';
            $post_reaction->created_at = Carbon::now();
            $post_reaction->save();
        }

        return response()->json([
            "data" => null,
            "status"  => 200,
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }
}
