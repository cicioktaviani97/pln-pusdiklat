<?php

use Illuminate\Http\Request;
use App\Http\Middleware\XAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return response()->json([
        "message" => "work",
        "data" => null,
    ], 200);
});

Route::middleware([XAuth::class])->group(function () {
    /* POST */
    Route::get('post', 'Api\PostController@index')->name('post.index');
    Route::post('post', 'Api\PostController@store')->name('post.store');
    Route::get('post/{id}', 'Api\PostController@show')->name('post.show');
    Route::post('post/id/{id}', 'Api\PostController@update')->name('post.update');
    Route::delete('post/{id}', 'Api\PostController@destroy')->name('post.delete');

    /* POST REACTION */
    Route::get('post_reaction', 'Api\PostReactionController@index')->name('post_reaction.index');
    Route::get('post_reaction/{posts_id}', 'Api\PostReactionController@post_reaction')->name('post_reaction.show');
    Route::post('up_vote', 'Api\PostReactionController@up_vote')->name('up_vote.store');
    Route::post('down_vote', 'Api\PostReactionController@down_vote')->name('down_vote.store');
    Route::post('agree', 'Api\PostReactionController@agree')->name('agree.store');
    Route::post('skeptic', 'Api\PostReactionController@skeptic')->name('skeptic.store');
    
});
