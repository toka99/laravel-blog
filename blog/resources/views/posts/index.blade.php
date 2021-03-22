@extends('layouts.app')

@section('title')Index Page @endsection

@section('content')

<a href="{{route('posts.create')}}" class="btn btn-success" style="margin-bottom: 20px;">Create Post</a>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Slug</th>
        <th scope="col">Posted By</th>
        <th scope="col">Created At</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
      <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{{ $post->slug}}</td>
        <td>{{ $post->user ? $post->user->name : 'user not found' }}</td>
        <td>{{ $post->created_at->format('Y-m-d ') }}</td>
        <td>
          <a href="{{ route('posts.show',['post' => $post->id]) }}" class="btn btn-info" >View</a>
          <a href="{{ route('posts.edit',['post' => $post->id]) }}" class="btn btn-secondary" >Edit</a>
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_post_{{$post->id}}" >Delete</button>
                </td>
            </tr>
            <div id="del_post_{{$post->id}}" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete</h4>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <form method="POST" action="{{route('posts.destroy', ['post' => $post['id']])}}" accept-charset="UTF-8">
                            @csrf
                            @method('DELETE')
                            <div class="modal-body">
                                <h4>Do you want to delete post with title {{$post->title}} ?</h4>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                <input class="btn btn-danger" type="submit" value="Yes">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
    <div class="container">
        {{$posts->links("pagination::bootstrap-4")}}
    </div>  

@endsection