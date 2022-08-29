<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::paginate(Post::PerPage);

        return PostResource::collection($posts);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param PostStoreRequest $request
     * @return PostResource
    */
    public function store(PostStoreRequest $request)
    {
         $post = Post::create($request->validated());

         return new PostResource($post);
    }



    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return PostResource
    */
    public function show(Post $post)
    {
         return new PostResource($post);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param PostUpdateRequest $request
     * @param Post $post
     * @return PostResource
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
         $post->update($request->validated());

         return new PostResource($post);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return Response
     */
    public function destroy(Post $post)
    {
         $post->delete();

         return response(null, Response::HTTP_NO_CONTENT);
    }
}
