<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $orderWhitelist = [
        "title", "created_at", "updated_at"
    ];

    protected $sortWhitelist = [
        "asc", "desc"
    ];

    protected $privasiPublic = "public";
    protected $privasiParticipant = "participant";

    protected $privasiWhitelist = [
        "public", "participant"
    ];

    public function index(Request $request)
    {
        $query = Post::query();
        if($request->has("search")){
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if($request->has("order") && $request->has("sort")){
            if(!in_array($request->order, $this->orderWhitelist)){
                return response()->json([
                    "data" => null,
                    "status" => 403,
                    "message" => "validate_order"
                ]);
            }

            if(!in_array($request->sort, $this->sortWhitelist)){
                return response()->json([
                    "data" => null,
                    "status" => 403,
                    "message" => "validate_sort"
                ]);
            }

            $query->orderBy($request->order, $request->sort);
        }

        $limit = ($request->has("limit")) ? $request->limit : 10;
        $posts = $query->where("privasi", $this->privasiPublic)->paginate($limit)->appends(request()->query());

        return PostCollection::collection($posts)->additional([
            "status" => 200,
            "messsage" => "success"
        ]);
    }

    public function store(StorePostRequest $request)
    {
        // handling upload thumbnail
        if($request->has("file")){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

            $request->merge([
                "thumbnail" => $filePath
            ]);
        }

        $request->merge([
            "author_user_id" => Auth::user()->id,
        ]);

        Post::create($request->all());

        return response()->json([
            "data" => null,
            "status"  => 200,
            "message" => "Data Berhasil Disimpan"
        ], 201);
    }

    public function show($id)
    {
        $post = Post::with("discussion_relation","category_relation","user_relation")
                ->where("id", $id)
                ->first();

        return (new PostCollection($post))->additional([
            "status" => 200,
            "messsage" => "success"
        ]);
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        if(!$post){
            return response()->json([
                "status" => 403,
                "message" => "post_not_found",
                "data" => null,
            ], 403);
        }

        if($request->file != ''){
            if($request->has("file")){
                if(Storage::exists($post->thumbnail)){
                    Storage::delete($post->thumbnail);
                }

                $fileName = time().'_'.$request->file->getClientOriginalName();
                $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

                $request->merge([
                    "thumbnail" => $filePath
                ]);

            }
        }

        $request->merge([
            "author_user_id" => Auth::user()->id,
        ]);

        $post->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Data Berhasil Update',
            'data' => null
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if($post->thumbnail == ''){
            $post->delete();
        }else{
            Storage::disk('public')->delete($post->thumbnail);
            $post->delete();
        }

        return response()->json([
            "data" => null,
            'status' => 'OK',
            'message' => 'Data Berhasil Hapus'
        ], 200);
    }
}
