<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class XAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $authID = $request->header('X-Auth-ID');

        if(!$authID){
            return response()->json([
                "status" => 401,
                "message" => "unautorized",
                "data" => null,
            ], 401);
        }

        $user = User::where('id',$authID)->first();
        if(!$user){
            return response()->json([
                "status" => 401,
                "message" => "auth_not_recognized",
                "data" => null,
            ], 401);
        }

        // $request->merge([
        //     "author_user_id" => $authID
        // ]);
        Auth::loginUsingId($user->id);

        return $next($request);
    }
}
