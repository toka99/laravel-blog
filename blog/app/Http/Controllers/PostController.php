<?php

namespace App\Http\Controllers;
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

    public function edit (Post $post, Request $request){
      
         $post->edit($request->all());
        return redirect()->route('posts.index');
    }

    public function store(Request $request) // == calling request()
    {
        $requestData = $request->all();
        Post::create($requestData);
        return redirect()->route('posts.index');
    }
    public function destroy(Post $post) {
        $post->delete();
        return redirect()->route('posts.index');
    }
}
