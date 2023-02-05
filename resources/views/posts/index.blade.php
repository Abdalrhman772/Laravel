@extends('layouts.app')

@section('title') index @endsection

@section('content')

<style>
    body{
        background-color: rgb(4, 69, 122)
    }
</style>

<div class="text-end">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-success">Create Post</a>
</div>
<div class="card mt-1">
    <div class="card-body">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col" style="text-align:center">Actions</th>
                </tr>
            </thead>
            <tbody>
        
                @foreach($posts as $post)
                {{-- @dd($post)--}}
                <tr>
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->user['name'] ?? "not found"}}</td>
                    <td>{{$post['created_at']->format('Y-m-d')}}</td>
                    <td style="text-align:center">
                        <form action="{{ route('posts.destroy',$post->id)}}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                           <a href="{{route('posts.show', $post->id)}}" class="btn btn-info text-light">View</a>
                           <a href="{{route('posts.edit', $post['id'])}}" class="btn btn-primary">Edit</a>
                           <button class="btn btn-danger">Delete</button>
                       </form>
                    </td>
                </tr>
                @endforeach
        
        
            </tbody>
        </table>
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection