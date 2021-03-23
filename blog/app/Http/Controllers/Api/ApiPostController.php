<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\UserResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

class ApiPostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->all());

        return new PostResource($post);
    }
}
