<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StorePostRequest2;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{ 
    public function index()
    { 
        $posts = Post::paginate(2);
        return view('posts.index', compact('posts'));
    }

    public function show($postId)
    {
        $post = Post::find($postId);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('posts.create',[
            'users' => User::all()
        ]);
    }
    public function edit(Post $post){
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(Post $post, StorePostRequest2 $request){
        $post->update($request->all());
        return redirect()->route('posts.index');
    }

    public function store(StorePostRequest $request) // == calling request()
    {   
        //validation logic 

        $requestData = $request->all();
        Post::create($requestData);
        return redirect()->route('posts.index');
    }
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
